<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class productSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $d1 = 'Casual Shirt for Men and Boys Premium Quality and Stylish Fit Dress Shirt Ideal for a Fashionable Look';
        $d2 = 'Dot Printed Office Wear Gents Dress Semi-Formal Shirt for Men Stay Stylish with Our Dot Printed Semi-Formal Shirt: Fashionable, Trendy, Premium Quality, and Finely Stitched';
        $d3 = 'Shirt For Men And Boys In Premium Quality For Efficient Look Quality Dress Shirt';
        $d4 = 'men Fashion cotton pents for men cotton jean cotton pents fashion cotton china cotton pants for men dress cotton pents';
        $d5 = '6 pocket cargo for men and boys slim fit pure cotton';
        $d6 = 'Mens Pure Cotton Cargo pent for Men,6 pocket cargo pent';
        $d7 = 'Physics A Course for O Level Textbook By Dr Charles Chew';
        $d8 = 'ilmi Physical Chemistry for BSC Textbook by Sana Ullah';
        $d9 = '3D Famous Car Remote Control Car With 3D Lights';
        $d10 = 'LittleChef Backpack Series Kitchen Cooking Toy Set with Accesssories doctor set for girls Pretend Play Toys for Childrens';

        $P1 = [
            'name' => 'Men shirt',
            'description' => $d1,
            'quantity' => 10,
            'price' => 999,
            'category_id' => 1,
            'image' => '/img/1.png',
            'slug'=> Str::slug($d1),
            
        ];
        
        $P2 = [
            'name' => 'Formal Shirt',
            'description' => $d2,
            'quantity' => 10,
            'price' => 499,
            'category_id' => 1,
            'image' => '/img/2.png',
            'slug'=> Str::slug($d2),
            
        ];

        $P3 = [
            'name' => 'Dress Shirt',
            'description' => $d3,
            'quantity' => 10,
            'price' => 1009,
            'category_id' => 1,
            'image' => '/img/3.png',
            'slug'=> Str::slug($d3),
            
        ];

        $P4 = [
            'name' => 'Cotton pent',
            'description' => $d4,
            'quantity' => 10,
            'price' => 1398,
            'category_id' => 1,
            'image' => '/img/4.png',
            'slug'=> Str::slug($d4),
            
        ];
        $P5 = [
            'name' => '6 pocket pent',
            'description' => $d5,
            'quantity' => 10,
            'price' => 1498,
            'category_id' => 1,
            'image' => '/img/5.png',
            'slug'=> Str::slug($d5),
            
        ];

        $P6 = [
            'name' => 'Men Pure Cotton',
            'description' => $d6,
            'quantity' => 10,
            'price' => 1499,  
            'category_id' => 1,
            'image' => '/img/6.png',
            'slug'=> Str::slug($d6),
            
        ];

        $P7 = [
            'name' => 'Physics Book',
            'description' => $d7,
            'quantity' => 10,
            'price' => 3199,  
            'category_id' => 1,
            'image' => '/img/book1.png',
            'slug'=> Str::slug($d7),
            
        ];

        $P8 = [
            'name' => 'Chemistry Book',
            'description' => $d8,
            'quantity' => 10,
            'price' => 1075,  
            'category_id' => 1,
            'image' => '/img/book2.png',
            'slug'=> Str::slug($d8),
            
        ];

        $P9 = [
            'name' => 'Car Remote',
            'description' => $d9,
            'quantity' => 10,
            'price' => 1149,  
            'category_id' => 1,
            'image' => '/img/7.png',
            'slug'=> Str::slug($d9),
            
        ];

        $P10 = [
            'name' => 'Kitchen Set',
            'description' => $d10,
            'quantity' => 10,
            'price' => 1085,  
            'category_id' => 1,
            'image' => '/img/8.png',
            'slug'=> Str::slug($d10),
            
        ];

        Product::create($P1);
        Product::create($P2);
        Product::create($P3);
        Product::create($P4);
        Product::create($P5);
        Product::create($P6);
        Product::create($P7);
        Product::create($P8);
        Product::create($P9);
        Product::create($P10);
        
    }
}
