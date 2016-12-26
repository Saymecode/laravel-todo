<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;


class CategoryController extends Controller
{
    public function store(Request $request, Category $categoryModel)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:30',
        ]);

        $categoryModel->name = $request->name;
        $categoryModel->save();

        return response()->json(['success' => true]);
    }
}