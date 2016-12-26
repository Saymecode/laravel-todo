<?php

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Task;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('CategorySeeder');
        $this->call('TaskSeeder');
    }
}

class CategorySeeder extends Seeder {

    public function run()
    {
        DB::table('categories')->delete();
        Category::create([
            'id' => 1,
            'name' => 'Category 1',
        ]);
        Category::create([
            'id' => 2,
            'name' => 'Category 2',
        ]);
        Category::create([
            'id' => 3,
            'name' => 'Category 3',
        ]);
    }
}

class TaskSeeder extends Seeder
{
    public function run()
    {
        DB::table('tasks')->delete();
        Task::create([
            'id' => 1,
            'idCategory' => 1,
            'name' => 'Complete test',
            'done' => true,
        ]);
        Task::create([
            'id' => 2,
            'idCategory' => 2,
            'name' => 'Learn Laravel',
            'done' => false,
        ]);
        Task::create([
            'id' => 3,
            'idCategory' => 3,
            'name' => 'Rule the world',
            'done' => false,
        ]);
    }
}