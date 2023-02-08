<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            [
                'name' => 'andi',
                'email' => 'andi@gmail.com',
                'email_verified_at' => now(),
                'gender' => 'Male',
                'country' => 'Indonesia',
                'dateofbirth' => '2001-01-01',
                'isAdmin' => true,
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            ]
        );

        User::create(
            [
                'name' => 'tono',
                'email' => 'tono@gmail.com',
                'email_verified_at' => now(),
                'gender' => 'Male',
                'country' => 'Indonesia',
                'dateofbirth' => '2001-01-01',
                'isAdmin' => false,
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            ]
        );

        Cart::create(
            [
                'user_id' => 1
            ]
        );

        Cart::create(
            [
                'user_id' => 2
            ]
        );

        $products = Product::factory()->count(15);

        User::factory()->count(10)->has(Cart::factory()->count(1))->create();

        $categories = Category::factory()->count(5)->has($products)->create();

        foreach (Cart::all() as $cart) {
            $products = Product::take(rand(1, 5))->pluck('id');
            $cart->products()->attach($products, [
                'quantity' => rand(1, 50),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
