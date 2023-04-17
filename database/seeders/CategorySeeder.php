<?php
declare(strict_types = 1);

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

final class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::query()->insert([
            ['name' => 'Carnes'],
            ['name' => 'Peixe'],
            ['name' => 'Tortas'],
            ['name' => 'Acompanhamentos'],
            ['name' => 'Massas'],
            ['name' => 'Sobremesas'],
            ['name' => 'Sopas'],
        ]);
    }
}
