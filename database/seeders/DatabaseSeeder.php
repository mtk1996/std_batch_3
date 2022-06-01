<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
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
        // User
        User::create([
            'name' => "User One",
            'email' => "userone@a.com",
            'password' => Hash::make('password'),
            'phone' => '09999999',
            'address' => 'Address',
        ]);
        User::create([
            'name' => "Admin",
            'email' => "admin@a.com",
            'password' => Hash::make('password'),
            'phone' => '09999999',
            'address' => 'Address',
            'role' => "admin"
        ]);

        Supplier::create([
            'name' => 'Supplier One',
            'image' => 'supplier.png',
        ]);

        // Brand
        $brands = ['Huawei', 'Samsung', 'Apple', 'Xiaomi'];
        foreach ($brands as $b) {
            Brand::create([
                'slug' => Str::slug($b),
                'name' => $b,
            ]);
        }

        // Category
        $category = ['Phone', 'Cover', 'Accessory', 'Smart Watch'];
        foreach ($category as $b) {
            Category::create([
                'slug' => Str::slug($b),
                'name' => $b,
            ]);
        }

        // Color
        $color = ['red', 'green', 'blue',];
        foreach ($color as $b) {
            Color::create([
                'slug' => Str::slug($b),
                'name' => $b,
            ]);
        }
    }
}
