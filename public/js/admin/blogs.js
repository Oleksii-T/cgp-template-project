$(document).ready(function () {
    let table = $('#blogs-table').DataTable({
        order: [[ 0, "desc" ]],
        serverSide: true,
        ajax: {
			url: window.location.href
		},
        columns: [
            { data: 'id', name: 'id' },
            { data: 'title', name: 'title' },
            { data: 'content', name: 'content' },
            { data: 'created_at', name: 'created_at', searchable: false },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });

    $(document).on('click', '#blogs-table .delete-resource', function (e) {
        e.preventDefault();
        deleteResource(table, $(this).data('link'));
    });

    $('.add-image-input').click(function(e) {
        e.preventDefault();
        $(this)
            .closest('.card')
            .find('.image-input.clone')
            .clone()
            .appendTo($(this).closest('.card').find('.row'))
            .removeClass('d-none')
            .removeClass('clone');
    })

    $(document).on('click', '.delete-image-input', function (e) {
        e.preventDefault();
        let el = $(this).closest('.image-input');
        let url = $(this).data('url');
        console.log(url);
        if (!url) {
            el.remove();
            return;
        }
        showLoading();

        $.ajax({
            url: url,
            type: 'post',
            data: {
                _method: 'DELETE',
                _token: $('meta[name=csrf-token]').attr('content')
            },
            success: (response)=>{
                el.remove();
                swal.close();
            },
            error: function(response) {
                showServerError(response);
            }
        });

    })
});
