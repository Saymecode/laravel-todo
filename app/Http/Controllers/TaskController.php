<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Task;
use Illuminate\Http\Request;


class TaskController extends Controller
{
    public function index(Request $request, Category $categoryModel, Task $taskModel, $idCategory = null)
    {
        if (isset($request->idCategory)) $idCategory = $request->idCategory;

        return view('task.index', [
            'categories' => $categoryModel->getCategories(),
            'tasks' => $taskModel->search($idCategory),
            'tasksCount' => $taskModel->countTasks(),
            'idActiveCategory' => $idCategory ? $idCategory : 0,
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'id' => 'integer',
            'idCategory' => 'integer',
            'name' => 'required|min:3|max:30',
        ]);

        $request->id == 0 ? $model = new Task : $model = Task::find($request->id);
        $model->name = $request->name;
        $request->idCategory ? $model->idCategory = $request->idCategory : $model->idCategory = null;
        $model->save();

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $model = Task::find($id);
        $model->delete();

        return response()->json(['success' => true]);
    }

    public function setStage(Request $request)
    {
        $model = Task::find($request->id);
        $model->done = $request->isDone;
        $model->save();

        return response()->json(['success' => true]);
    }

    public function update(Request $request)
    {
        $model = Task::find($request->id);
        $model->name = $request->name;
        $model->idCategory = $request->idCategory;
        return response()->json(['success' => true]);
    }
}