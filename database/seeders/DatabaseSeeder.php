<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'     => 'Admin',
            'email'    => 'admin@gmail.com',
            'password' => bcrypt('admin')
        ]);

        Category::create(['name' => 'Fashion']);
        Category::create(['name' => 'Kerajinan Tangan']);
        Category::create(['name' => 'Kuliner']);

        Product::insert([
            [
                'name' => 'Ayam Geprek',
                'slug' => Str::slug('Ayam Geprek'),
                'image' => 'Ayam Geprek.jpg',
                'price' => 15000,
                'category_id' => 3,
            ],
            [
                'name' => 'Kemeja Polos',
                'slug' => Str::slug('Kemeja Polos'),
                'real' => 90000,
                'image' => 'Kemeja Polos.jpg',
                'category_id' => 1,
            ]
        ]);
    }
}
