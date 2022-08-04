$(document).ready(function () {
    $('#menus-table').DataTable({
        order: [[ 0, "asc" ]],
        serverSide: true,
        ajax: {
			url: window.location.href
		},
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });


    if ($('input[name="code"]').val() === 'main') {
        $(".sortable").sortable({
            connectWith: '.sortable',
            handle: '.item-handle',
            stop: function (event, ui) {
                editor.enableButton();
                if ($(ui.item).find('.sortable li').length) {
                    $(this).sortable( "cancel" );
                }
            },
            cancel: ".edit-item,.remove-item",
        });
    } else {
        $("#sortable").sortable({
            stop: function (event, ui) {
                editor.enableButton();
            },
            cancel: ".edit-item,.remove-item"
        });
    }

    $("#sortable").disableSelection();
    let editor = {
        token: '',
        items: {},
        sort: false,
        edit: false,
        code: '',
        inputFile: $('#iconImage'),
        inputImage: $('input[name="image"]'),
        file: null,
        init: function (items) {
            this.setToken();
            this.setCode();
            this.items = items;

            $('#EditorForm').on('submit', function (e) {
                e.preventDefault();
                if (editor.sort) {
                    swal.fire('Error', 'You need to save or cancel the edit menu.', 'error');
                    return false;
                }
                let formData = new FormData(this);
                let _this = editor;
                $.ajax({
                    url: '/admin/menus/store',
                    type: 'post',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        if (data.status === 'success') {
                            $('#sortable').html(data.html);

                            if (!_this.edit) {
                                let $item = $('#sortable li:last-child');
                                $item.css('border-color', '#3c8dbc');

                                setTimeout(function () {
                                    $item.css('border-color', '#c5c5c5');
                                }, 3000);

                                $('html, body').stop().animate({
                                    'scrollTop': $('#sortable li:last-child').offset().top - 50
                                }, 500);
                            }

                            if (typeof _this.items[data.id] !== 'undefined') {
                                _this.items[data.id].title = $('#EditorForm input[name="title"]').val();
                                _this.items[data.id].link = $('#EditorForm input[name="link"]').val();
                                _this.items[data.id].icon = data.icon;
                            } else {
                                _this.items[data.id] = {
                                    title: $('#EditorForm input[name="title"]').val(),
                                    link: $('#EditorForm input[name="link"]').val(),
                                    sort: data.sort
                                };
                            }

                            _this.changeOperation('new');
                        } else {
                            $.each(data.message, function (field, value) {
                                $('.invalid-feedback[data-field="' + field + '"]').text(value).show();
                            });

                            $("html, body").animate({scrollTop: $(".invalid-feedback:visible").first().offset().top - 100}, "fast");
                        }
                    }
                });

                return false;
            });

            $('#SaveSort').on('click', function () {
                editor.SaveSort();
            });

            $('#CancelSort').on('click', function () {
                editor.CancelSort();
            });

            $(document).on('click', '.remove-item', function () {
                editor.RemoveItem($(this).closest('li'));
            });

            $(document).on('click', '.edit-item', function (e) {
                e.preventDefault();
                editor.EditItem($(this).closest('li'));
            });

            $('.operation-button-cancel').on('click', function () {
                editor.changeOperation('new');
            });

            $('#iconImage').on('change', function () {
                editor.changeIcon($(this));
            });
        },
        reSort: function () {
            let items = this.items;

            $('#sortable .list-group-item').each(function (i, ui) {
                items[parseInt($(ui).data('id'))]['sort'] = i;
                if (!$(ui).parent().parent().hasClass('card-body') && $(ui).parent().parent().data('id') !== $(ui).data('id')) {
                    items[parseInt($(ui).data('id'))]['parent'] = $(ui).parent().parent().data('id');
                } else {
                    delete items[parseInt($(ui).data('id'))]['parent'];
                }
            });

            this.items = items;
            this.enableButton();
        },
        SaveSort: function () {
            this.reSort();
            let _this = this;

            this.ajax({
                success: function (data) {
                    if (data.status === 'success') {
                        $('#SaveSort').prop('disabled', true);
                        $('#CancelSort').hide();

                        _this.sort = false;
                    } else {
                        swal.fire('Error', data.message, 'error');
                    }
                },
                data: {
                    _token: this.token,
                    code: this.code,
                    items: this.items
                },
                url: 'save-sortable'
            });
        },
        CancelSort: function () {
            let _this = this;

            this.ajax({
                success: function (data) {
                    if (data.status === 'success') {
                        $('#SaveSort').prop('disabled', true);
                        $('#CancelSort').hide();
                        $('#sortable').html(data.html);

                        _this.sort = false;
                    } else {
                        swal.fire('Error', data.message, 'error');
                    }
                },
                data: {
                    _token: this.token,
                    code: this.code
                },
                url: 'get-sortable'
            });
        },
        EditItem: function (li) {
            if (this.sort) {
                swal.fire('Error', 'You need to save or cancel the edit menu.', 'error');
                return false;
            }

            let id = li.data('id');
            this.li = li;

            if (typeof this.items[id] !== 'undefined') {
                $("#sortable").sortable("disable");
                this.changeOperation('edit');

                $('#EditorForm input[name="title"]').val(this.items[id].title);
                $('#EditorForm input[name="link"]').val(this.items[id].link);
                $('#EditorForm input[name="icon"]').closest('.form-group').find('img').attr('src', this.items[id].icon);
                $('#EditorForm input[name="item_id"]').remove();
                $('#EditorForm').append('<input type="hidden" name="item_id" value="' + id + '">');
            }
        },
        changeOperation: function (type) {
            $('#EditorForm')[0].reset();
            $('.invalid-feedback').hide();

            if (type === 'new') {
                $("#sortable").sortable("enable");
                this.edit = false;

                $('.operation-title').text('New item')
                $('.operation-button').text('Add');
                $('.operation-button-cancel').hide();
                $('#EditorForm input[name="item_id"]').remove();

                $('.input-product-img-wrpr').hide();
                $('.input-product-img-wrpr img').attr('src', '');
                $('.custom-file-label').text('');
                $('[name^="icon[').remove();
            } else {
                this.edit = true;

                $('.operation-title').text('Update item')
                $('.operation-button').text('Update');
                $('.operation-button-cancel').show();
            }
        },
        RemoveItem: function (li) {
            if (this.edit) {
                swal.fire('Error', 'Cannot be deleted when editing.', 'error');
                return false;
            }

            let id = li.data('id');
            let _this = this;

            swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    this.ajax({
                        success: function (data) {
                            if (data.status === 'success') {
                                li.remove();
                                delete _this.items[id];
                                swal.fire('Deleted!', '', 'success');
                            } else {
                                swal.fire('Error', data.message, 'error');
                            }
                        },
                        data: {
                            _token: this.token,
                            id: id
                        },
                        url: 'destroy'
                    });
                }
            });
        },
        enableButton: function () {
            if (!this.sort) {
                $('#SaveSort').prop('disabled', false);
                $('#CancelSort').show();

                this.sort = true;
            }
        },
        setToken: function () {
            this.token = $('input[name="_token"]').val();
        },
        setCode: function () {
            this.code = $('input[name="code"]').val();
        },
        changeIcon: function ($input) {
            console.log(this.inputImage);
            console.log('$input', $input);

            if (typeof $input.prop('files')[0] !== 'undefined') {
                if ($input.prop('files')[0].type.split('/')[0] === 'image') {
                    let reader = new FileReader();

                    reader.onload = function (e) {
                        $('.input-product-img-wrpr img').attr('src', e.target.result);
                        $('.input-product-img-wrpr').show();
                    };

                    reader.readAsDataURL($input.prop('files')[0]);
                    this.file = $input.prop('files')[0];
                    $('.custom-file-label').text(this.file.name);
                    this.inputImage.val('');
                } else {
                    swal.fire('Error!', 'The file must be an image.', 'error');
                    $input.val('');
                }
            }
        },
        ajax: function (request) {
            if(!request.beforeSend){
                request.beforeSend = function(){
                    $('.invalid-feedback').hide();
                }
            }
            $.ajax({
                type: 'POST',
                url: '/admin/menus/' + request.url,
                data: request.data,
                success: request.success,
                beforeSend: request.beforeSend,
                error: function () {
                    swal.fire('Error', 'System error', 'error');
                }
            });
        }
    };

    if(typeof items !== 'undefined'){
        editor.init(items);
    }
});
