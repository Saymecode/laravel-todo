$(document).ready(function () {
    openTaskForm();
    openCategoryForm();
    onSubmitForm();
    onSubmitDeleteForm();
    onChangeStage();
    showCertainTasks();
    clearFadeBlock();
});

function openCategoryForm() {
    $(document).on('click', '.content button[data-action="create-category"]', clearCategoryForm);
}

function clearCategoryForm() {
    $('#category-form [name="name"]').val('');
    $('.alert-danger').addClass('hidden');
}

function getActiveCategory() {
    return $('.panel-body.list-group a.list-group-item.active').data('active-category');
}

function openTaskForm() {
    $(document).on('click', '.content button[data-action="Create task"], .content button[data-action="Update task"]', function () {
        clearTaskForm();
        $('#task-form [name="idCategory"] option[value="' + getActiveCategory() + '"]').prop('selected', true);
        $('#task-form .modal-title').text($(this).data('action'));
        if ($(this).data('action') == "Update task") {
            $('#task-form [name="id"]').val($(this).data('id-task'));
            $('#task-form [name="name"]').val($(this).data('name'));
            $('#task-form [name="idCategory"] option[value="' + $(this).data('id-category') + '"]').prop('selected', true);
        }
        else {
            $('#task-form [name="id"]').val(0);
        }
    });
}

function clearTaskForm() {
    $('.alert-danger').addClass('hidden');
    $('#task-form [name="name"]').val('');
    $('#task-form [name="idCategory"]').prop('selectedIndex', 0);
}

function updatePageContent(token, activeCategory) {
    $.get('task/category', {_token: token, idCategory: activeCategory,}, function (response) {
        $('.content').replaceWith($(response).find('.content'));
    });
}

function requireValidate(input) {
    return !($(input).val() == "");
}

function lengthValidate(input) {
    return $(input).val().length >= $(input).attr("minlength");
}

function removeErrors(form) {
    form.find('.alert-danger ul li').remove();
    $('.alert-danger').addClass('hidden');
}

function addErrorToForm(form, message) {
    form.find('.alert-danger ul').append(message);
}

function onSubmitForm() {
    $(document).on('submit', '#task-form, #category-form', function (event) {
        event.preventDefault();
        var form = $(this);
        var requiredInputs = $(form).find("input[required]");
        var mustBeNotShortInputs = $(form).find("input[minlength]");

        removeErrors(form);

        for (var i = 0; i < requiredInputs.length; i++) {
            if (!requireValidate(requiredInputs[i])) {
                $('.alert-danger').removeClass('hidden');
                addErrorToForm(form, '<li>' + 'Input ' + $(requiredInputs[i]).attr('name') + ' can not to be empty' + '</li>');
            }
        }

        for (var i = 0; i < mustBeNotShortInputs.length; i++) {
            if (!lengthValidate(mustBeNotShortInputs[i])) {
                $('.alert-danger').removeClass('hidden');
                addErrorToForm(form, '<li>' + 'Input ' + $(mustBeNotShortInputs[i]).attr('name') + ' must have at least ' + $(mustBeNotShortInputs[i]).attr('minlength') + ' letters' + '</li>');
            }
        }

        if ($('.alert-danger').hasClass('hidden')) {
            $.post(form.attr('action'), form.serialize(), function (response) {
                if (response.success) {
                    $('#create_task_modal, #create_category_modal').modal('hide');
                    updatePageContent($(this).data('token'), getActiveCategory());
                    fadePopUp("button.close", ".modal-backdrop.fade.in");
                }
            }, 'json').error(function (response) {
                alert("Error during saving");
            });
        }
    });
}

function onSubmitDeleteForm() {
    $(document).on('submit', '#delete-form', function (event) {
        event.preventDefault();
        var form = $(this);
        var token = $(this).data('token');
        if (confirm('Do you really want to delete this task?')) {
            $.post(form.attr('action'), form.serialize(), function (response) {
                if (response.success) {
                    updatePageContent(token, getActiveCategory());
                }
            }, 'json').error(function (response) {
                alert('Error during deleting!');
                updatePageContent(token, getActiveCategory());
            });
        }
    });
}

function setStyleTaskDone(li) {
    li.removeClass('todo');
    li.addClass('done');
}

function setStyleTaskToDo(li) {
    li.removeClass('done');
    li.addClass('todo');
}

function onChangeStage() {
    $(document).on('change', '.todo-list li input[type="checkbox"]', function () {
        var li = $(this).closest('li');
        var url = 'task/setstage';
        var token = $(this).data('token');
        if ($(this).prop('checked')) {
            setStyleTaskDone(li);
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    _token: token,
                    id: li.attr('data-id-task'),
                    isDone: "1"
                },
                dataType: "JSON",
                error: function () {
                    alert("Status changing error!");
                }
            });
        }
        else {
            setStyleTaskToDo(li);
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    _token: token,
                    id: li.attr('data-id-task'),
                    isDone: "0"
                },
                dataType: "JSON",
                error: function () {
                    alert("Status changing error!");
                }
            });
        }
    });
}

function showCertainTasks() {
    $(document).on('click', '.panel-body.list-group a', function (event) {
        event.preventDefault();
        updatePageContent($(this).data('token'), $(this).attr('data-active-category'));
    });
}

function clearFadeBlock() {
    $(document).on("click", ".modal-backdrop.fade.in", function () {
        $("button.close").trigger('click');
        $(".modal-backdrop.fade.in").remove();
    })
}

function fadePopUp(buttonCloseClassName, popUpClassName) {
    $(buttonCloseClassName).trigger('click');
    $(popUpClassName).remove();
}