<?php
declare(strict_types = 1);

namespace Database\Seeders;

use App\Models\Kitchen;
use Illuminate\Database\Seeder;

final class KitchenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kitchen::insert([
            ['description' => 'SP'],
            ['description' => 'RJ'],
            ['description' => 'MG'],
            ['description' => 'BA'],
        ]);
    }
}
