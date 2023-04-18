<?php
declare(strict_types = 1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

/**
 * @property int $id
 * @property Kitchen $kitchen_id
 * @property Category $category_id
 * @property string $name
 * @property float $price
 * @property int $calories
 * @property bool $in_stock
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $produced_at
 * @property-read Kitchen $kitchen
 * @property-read Category $category
 */
final class Dish extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $with = ['category', 'kitchen'];

    protected $fillable = [
        'kitchen_id',
        'category_id',
        'name',
        'price',
        'calories',
        'in_stock',
    ];

    protected static function booted(): void
    {
        self::created(fn (Dish $dish) => self::clearCache());
        self::updated(fn (Dish $dish) => self::clearCache());
        self::deleted(fn (Dish $dish) => self::clearCache());
    }

    private static function clearCache(): void
    {
        Cache::tags(['powergrid-dishes-simpleTable'])->flush();
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function kitchen(): BelongsTo
    {
        return $this->belongsTo(Kitchen::class);
    }

    public static function servedAt()
    {
        return self::select('serving_at')->distinct('serving_at')->get();
    }
}
