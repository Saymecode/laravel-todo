<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    public function tasks()
    {
        return $this->hasMany('app\Models\Task');
    }

    public function getCategories()
    {
        return self::orderBy('name', 'asc')->get();
    }

    public function countTask()
    {
        return Task::all()->where('idCategory', $this->id)->count();
    }
}
