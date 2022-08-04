$(document).ready(function () {
    $('.summernote').summernote();
    $('.select2').select2();

    // general logic of ajax form submit (supports files)
    $('form.general-ajax-submit').submit(function(e){
        e.preventDefault();
        showLoading();
        let form = $(this);
        let formData = new FormData(this);
        $('.input-error').empty();

        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (response)=>{
                showServerSuccess(response);
            },
            error: function(response) {
                swal.close();
                showServerError(response);
            }
        });
    })

    // show uploaded file name
    $('.show-uploaded-file-name input').change(function () {
        let name = $(this).val().split('\\').pop();
        $(this).closest('.show-uploaded-file-name').find('.custom-file-label').text(name);
    })

    // show uploaded file preview
    $('.show-uploaded-file-preview input').change(function () {
        const [file] = this.files;
        if (file) {
            let el = $(this).closest('.show-uploaded-file-preview').find('.custom-file-preview');
            el.removeClass('d-none');
            el.attr('src', URL.createObjectURL(file));
        }
    })

    // trigger element by click manuly
    $('[data-trigger]').click(function() {
        $($(this).data('trigger')).trigger('click');
    })

    // copy text
    $('[data-copy]').click(function(e) {
        e.preventDefault();
        let text = $($(this).data('copy')).text();
        let message = $(this).data('message');
        var dummy = document.createElement("textarea");
        document.body.appendChild(dummy);
        dummy.value = text;
        dummy.select();
        document.execCommand("copy");
        document.body.removeChild(dummy);
        Toast.fire({
            icon: 'success',
            title: message??'Copied successfully'
        });
    })
});

// flash notification
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});

// general error logic, after ajax form submit been processed
function showServerError(response) {
    // TODO display errors from array inputs
    if (response.status == 422) {
        for (const [field, value] of Object.entries(response.responseJSON.errors)) {
            let errorText = '';
            let errorElement = $(`.input-error[data-input=${field}]`);
            errorElement = errorElement.length ? errorElement : $(`.input-error[data-input="${field}[]"]`);
            errorElement = errorElement.length ? errorElement : $(`[name=${field}]`).closest('.form-group').find('.input-error');
            errorElement = errorElement.length ? errorElement : $(`[name="${field}[]"]`).closest('.form-group').find('.input-error');
            for (const [key, error] of Object.entries(value)) {
                errorText = errorText ? errorText+'<br>'+error : error;
            }
            errorElement.html(errorText);
        }
    } else {
        swal.fire('Error!', 'Server error', 'error');
    }
}

// general success logic, after ajax form submit been processed
function showServerSuccess(response) {
    if (response.success) {
        swal.fire("Success!", response.message, 'success').then((result) => {
            if (response.data.redirect) {
                window.location.href = response.data.redirect;
            }
        });
    } else {
        swal.fire("Error!", response.message, 'error');
    }
}

//show loading unclosable popup
function showLoading(text='Request processing...') {
    swal.fire({
        title: 'Wait!',
        text: text,
        showConfirmButton: false,
        allowOutsideClick: false
    });
}
