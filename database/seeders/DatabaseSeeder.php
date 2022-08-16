<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        \App\Models\Role::create([
            'name' => 'admin',
            'status' => 1,
        ]);
        \App\Models\Role::create([
            'name' => 'customer',
            'status' => 1,
        ]);
        \App\Models\Payment::create([
            'name' => 'CHECK PAYMENTS',
            'description' => 'Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.',
            'status' => 1
        ]);
        \App\Models\Payment::create([
            'name' => 'Paypal MB Bank',
            'description' => 'Please transfer and please wait for us to check and respond. Only pick up during office hours 7:00 AM - 17:00 PM',
            'status' => 1
        ]);

        \App\Models\User::factory(5)->create();
        \App\Models\Category::factory(10)->create();
        \App\Models\Brand::factory(10)->create();
        \App\Models\Nation::factory(10)->create();
        \App\Models\Product::factory(30)->create();
        \App\Models\Tag::factory(10)->create();
        \App\Models\ProductTag::factory(15)->create();
        \App\Models\Coupon::factory(10)->create();
        \App\Models\Event::factory(15)->create();
        \App\Models\Comment::factory(15)->create();

    }
}
