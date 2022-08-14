$(document).ready(function () {
    //share blog
    $('.share-links__item.mail-share').click(function(e){
        e.preventDefault();
        let id = $(this).data('id');

        Swal.fire({
            title: 'Input email address',
            input: 'email',
            inputPlaceholder: 'Email address'
        }).then((result) => {
            if (result.isConfirmed) {
                loading('Blog been shared, please wait...');

                $.ajax({
                    url: '/blogs/share/email',
                    type: 'post',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        email: result.value,
                        id: id
                    },
                    success: (response)=>{
                        if (response.success) {
                            swal.fire('Success!', response.message, 'success');
                        } else {
                            swal.fire('Error!', 'Server error', 'error');
                        }
                    },
                    error: function(response) {
                        swal.fire('Error!', 'Server error', 'error');
                    }
                });
            }
        })
    })

    // change pricing interval tabs
    $('.pricing-actions__item').click(function(){
        let interval = $(this).data('interval');
        $('.pricing-actions__item').removeClass('active');
        $(this).addClass('active');
        $('.pricing-plans').addClass('d-none');
        $(`.pricing-plans[data-interval=${interval}]`).removeClass('d-none');
    })

});
