<?php

use Illuminate\Database\Seeder;
use App\Relationships\Category;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = ['Book','Cloth','Food','Medicine','Music','Entainment'];
        for($i=0;$i<count($category);$i++){
           Category::create(['name' => $category[$i]]);
        }
    }
}
