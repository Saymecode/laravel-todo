@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading lead clearfix">
                        Categories
                        <button type="button" class="btn btn-success pull-right" data-toggle="modal"
                                data-target="#create_category_modal" data-action="create-category">
                            Create New Category
                        </button>
                    </div>
                    <div class="panel-body list-group">
                        <a href="" class="list-group-item @if(!$idActiveCategory) active @endif"
                           data-token="{{ csrf_token() }}" data-active-category="0">
                            <span class="badge">{{ $tasksCount }}</span>
                            All
                        </a>
                        @foreach($categories as $category)
                            <a href="" class="list-group-item @if($idActiveCategory==$category->id) active @endif"
                               data-active-category="{{ $category->id }}" data-token="{{ csrf_token() }}">
                                <span class="badge">{{ $category->countTask() }}</span>
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading lead clearfix">
                        Tasks
                        <button type="button" class="btn btn-success pull-right" data-toggle="modal"
                                data-target="#create_task_modal" data-action="Create task">
                            Create New Task
                        </button>
                    </div>
                    <div class="panel-body">
                        <ul class="todo-list ui-sortable">
                            @foreach($tasks as $task)
                                <li class="{{ $task->done ? 'done':'todo' }}" data-id-task="{{ $task->id }}">
                                    <input type="checkbox" @if($task->done) checked="checked" @endif value=""
                                           data-token="{{ csrf_token() }}">
                                    <span class="text">{{ $task->name}}</span>
                                    <small class="label {{ isset($task->category) ? 'label-success' : 'label-warning' }}">{{ isset($task->category) ? $task->category->name : 'None'}}</small>
                                    <div class="tools">
                                        <button type="submit" data-active-category="{{ $idActiveCategory }}"
                                                data-id-category="{{ $task->idCategory}}"
                                                data-name="{{ $task->name }}"
                                                data-id-task="{{ $task->id }}"
                                                data-toggle="modal" data-target="#create_task_modal"
                                                data-action="Update task">
                                            <i class="glyphicon glyphicon glyphicon-pencil"></i>
                                        </button>
                                        {!!  Form::open([
                                            'route' => ['task.destroy','id'=>$task->id],
                                            'method' => 'delete',
                                            'id' => 'delete-form',
                                        ]) !!}
                                        <button type="submit"><i class="glyphicon glyphicon-remove-circle"></i></button>
                                        {{ Form::close() }}
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        @include('task._category_form')

        @include('task._task_form')
    </div>
@stop