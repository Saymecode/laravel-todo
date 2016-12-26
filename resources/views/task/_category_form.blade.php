<!-- CATEGORY MODAL START -->
<div id="create_category_modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {!!  Form::open([
                'route' => 'category.store',
                'method' => 'POST',
                'id' => 'category-form',
                'novalidate' => 'novalidate',
            ]) !!}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Create New Category</h4>
            </div>
            <div class="alert alert-danger hidden">
                <p><strong>Errors:</strong></p>
                <ul></ul>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>List Name</label>
                    <input name="name" type="text" class="form-control" placeholder="List Name" maxlength="30"
                           minlength="3" required>
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
            {!! Form::close() !!}
        </div>
    </div>
</div>
<!-- CATEGORY MODAL END -->