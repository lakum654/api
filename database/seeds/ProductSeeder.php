<?php

use Illuminate\Database\Seeder;
use App\Relationships\Product;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
       Product::create(['category_id' => 1, 'name' => 'Bhagavat Geeta', 'price' => 300]); 
       Product::create(['category_id' => 1, 'name' => 'Rich Dad Poor Dad', 'price' => 150]); 
       Product::create(['category_id' => 1, 'name' => 'Power Of Illussion', 'price' => 100]); 
       Product::create(['category_id' => 2, 'name' => 'Shirt', 'price' => 200]); 
       Product::create(['category_id' => 2, 'name' => 'T-Shirt', 'price' => 200]); 
       Product::create(['category_id' => 2, 'name' => 'Shoort', 'price' => 1000]); 
       Product::create(['category_id' => 3, 'name' => 'Sandwitch', 'price' => 100]); 
       Product::create(['category_id' => 3, 'name' => 'Panjabi', 'price' => 150]); 
       Product::create(['category_id' => 3, 'name' => 'Pizza', 'price' => 200]); 
       
    }
}
