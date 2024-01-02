<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            "name"=>"mobile",
            "desc"=>"Lorem, ipsum dolor sit amet consectetur adipisicing elit. Totam pariatur odio commodi quo quidem, molestiae excepturi delectus, dicta impedit nihil hic sit, minus dolorem illo vitae harum sed quae! Quam!"
        ]);
    }
}
