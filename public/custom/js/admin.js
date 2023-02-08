function isShowEnabled(model,is_show) {
    if(confirm('Действительно хотите сделать активным?')){
        isShowCheckedItems(model,is_show);
    }
}

function isShowDisabled(model,is_show) {
    if(confirm('Действительно хотите сделать неактивным?')){
        isShowCheckedItems(model,is_show);
    }
}

function checkedAll(ob) {
    if ($(ob).is(':checked')) {
        $('.checkbox_item_one').prop('checked', true);
    }
    else {
        $('.checkbox_item_one').prop('checked', false);
    }
    $('.selected_item_count').html($('.checkbox_item:checked').length);
    $('#action').show();
}

$('.checked_all').change(function () {
    checkedAll(this);
});

$('.checkbox_item').change(function () {
    $('.selected_item_count').html($('.checkbox_item:checked').length);
    $('.quasar-bulkActions--smallScreen').addClass('quasar-bulkActions--entered');
});

function isShowCheckedItems(model,is_show) {
    $('.ajax-loader').fadeIn(100);
    $('.checkbox_item:checked').each(function(){
        var item = this;
        $.ajax({
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data :{
                is_show: is_show,
                id: $(this).val()
            },
            url: "/admin/is-show/" + model,
            success: function(data){
                $(item).closest('tr').remove();
                $(item).closest('.tr-table').remove();
            }
        });
    });
    $('.ajax-loader').fadeOut(100);
}

function deleteCheckedItem(model) {
    if(confirm('Действительно хотите удалить?')){
        $('.ajax-loader').fadeIn(100);
        $('.checkbox_item:checked').each(function(){
            var item = this;
            $.ajax({
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/admin/" + model + "/" + $(this).val(),
                success: function(data){
                    $(item).closest('tr').remove();
                    $(item).closest('.tr-table').remove();
                }
            });
        });
        $('.ajax-loader').fadeOut(100);
    }
}

function restoreCheckedItem(model) {
    if(confirm('Действительно хотите восстановить?')){
        $('.ajax-loader').fadeIn(100);
        $('.checkbox_item:checked').each(function(){
            var item = this;
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data :{
                    id: $(this).val()
                },
                url: "/admin/restore/" + model,
                success: function(data){
                    $(item).closest('tr').remove();
                }
            });
        });
        $('.ajax-loader').fadeOut(100);
    }
}

$('.radio-form').change(function () {
    $(this).closest('form').submit();
});

$('.show-checkbox-content').click( function () {
    $('.quasar-bulkActions--smallScreen').toggleClass('quasar-bulkActions--entered');
});

function delItem(ob, id, model){
    if (confirm('Действительно хотите удалить')){
        $(ob).closest('tr').remove();
        $.ajax({
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/admin/" + model + "/" + id,
            success: function (data){

            }
        })
    }
}

$('.parent-nav').each(function () {
    if($(this).find('.active').length > 0){
        $(this).find('.nav-link:first').addClass('active');
        $(this).find('.collapse').addClass('show');
    }
});

function showError(message){
    $.gritter.add({
        title: 'Ошибка',
        text: message
    });
    return false;
}

function showMessage(message){
    $.gritter.add({
        title: 'Успех',
        text: message,
        class_name: 'success-gritter'
    });
    return false;
}

(function($){
    $.fn.getFormData = function(){
        var data = {};
        var dataArray = $(this).serializeArray();
        for(var i=0;i<dataArray.length;i++){
            data[dataArray[i].name] = dataArray[i].value;
        }
        return data;
    }
})(jQuery);


function showEditModal(modal,id){
    $('.ajax-loader').fadeIn();
    $.ajax({
        url:'/admin/' + modal +'/' + id + '/edit',
        type: 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            $('.ajax-loader').fadeOut();
            if(data.status == 0){
                showError(data.error);
                return;
            }
            $('#modal_list').html(data);
            $('#edit_modal').modal('show');

        }
    });
}

function saveModal(ob,model) {
    $('.ajax-loader').fadeIn();
    var form = $(ob).closest('form');
    var id = form.find("input[name=id]").val();
    var formData = form.getFormData();
    form.find('.alert').fadeOut(0);

    $.ajax({
        url:'/admin/' + model + '/' + id,
        type: 'PUT',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: formData,
        success: function (data) {
            $('.ajax-loader').fadeOut();
            if(data.status == 0){
                form.find('.alert').html(data.error);
                form.find('.alert').fadeIn(0);
                return;
            }
            showMessage(data.message);
            $('#edit_modal').modal('hide');
            getRowListModelAfterUpdate(model,data.id);
        }
    });
}

function getRowListModelAfterUpdate(model,id) {
    $.ajax({
        url:'/admin/' + model,
        type: 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            'id': id,
            'is_ajax': 1
        },
        success: function (data) {
            $('.ajax-loader').fadeOut();
            if(data.status == 0){
                showError(data.error);
                return;
            }

            if($('.row_' + id).length > 0){
                $('.row_' + id).replaceWith(data);
            }
            else {
                $('.card-table').find('tbody').prepend(data);
            }
        }
    });
}


function showFileModal(name,type) {
    $('.ajax-loader').fadeIn();

    $.ajax({
        url:'/media/modal',
        type: 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            name: name,
            type: type
        },
        success: function (data) {
            $('.ajax-loader').fadeOut();

            if(data.status == 0){
                $('#upload_image').find('.alert').html(data.error);
                $('#upload_image').find('.alert').fadeIn(0);
                return;
            }
            $('#modal_list').html(data);
            $('#upload_media_modal').modal('show');
        }
    });
}

function uploadMedia(ob) {
    $(ob).closest('form').submit();
}

function uploadImageSubmit(ob,event){
    event.preventDefault();
    var formData = new FormData($(ob)[0]);

    $.ajax({
        url:'/media/upload',
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: formData,
        async: true,
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            $('.ajax-loader').css('display','none');
            if(data.success == 0){
                showError(data.error);
                return;
            }

            $('img[name=' + $('#media_name').val() + '_src]').attr('src',data.name);
            $('input[name=' + $('#media_name').val() + ']').val(data.name);

            $(ob).closest('.modal').modal('hide');
        }
    });
}


