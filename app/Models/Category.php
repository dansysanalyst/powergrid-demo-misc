<?php
declare(strict_types = 1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
final class Category extends Model
{
    use HasFactory;

    public function dishes(): HasMany
    {
        return $this->hasMany(Dish::class, 'category_id');
    }
}
