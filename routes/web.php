<?php

Route::get('/', [
    'as'=>'task',
    'uses'=>'TaskController@index'
]);

Route::post('category/store', [
    'as' => 'category.store',
    'uses' => 'CategoryController@store'
]);

Route::post('task/store', [
    'as' => 'task.store',
    'uses' => 'TaskController@store'
]);

Route::post('task/setstage', [
    'as' => 'task.setstage',
    'uses' => 'TaskController@setStage'
]);

Route::get('task/category', [
    'as' => 'task.category',
    'uses' => 'TaskController@index'
]);

Route::delete('task/{id}', [
    'as' => 'task.destroy',
    'uses' => 'TaskController@destroy'
])->where('id', '[0-9]+');