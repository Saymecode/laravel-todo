<!-- TASK MODAL START -->
<div id="create_task_modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {!!  Form::open([
               'route' => 'task.store',
               'method' => 'POST',
               'id' => 'task-form',
               'novalidate' => 'novalidate',
           ]) !!}
            <input type="hidden" name="id" value="0" required>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Create New Task</h4>
            </div>
            <div class="alert alert-danger hidden">
                <p><strong>Errors:</strong></p>
                <ul></ul>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Task Name</label>
                    <input name="name" type="text" class="form-control" placeholder="Task" maxlength="30" minlength="3"
                           required>
                </div>
                <div class="form-group">
                    <label>Category</label>
                    <select name="idCategory" class="form-control">
                        <option value="0">None</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                </button>
                <button type="submit" class="btn btn-primary">
                    Save changes
                </button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
<!-- TASK MODAL END -->