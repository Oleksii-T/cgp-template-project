@extends('layouts.admin.app')

@section('title', 'Edit Menu')

@section('content_header')
    <x-admin.title
        text="Edit Menu"
        :bcRoute="['admin.menus.edit', $menu]"
    />
@stop

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <form role="form" id="EditorForm">
                    @csrf
                    <input type="hidden" name="code" value="{{ $menu->code }}">

                    <div class="card-header">
                        <h3 class="card-title operation-title">New item</h3>
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="code" value="{{ $menu->code }}">
                        <div class="form-group">
                            <label for="inputTitle">Title</label>
                            <input type="text" name="title" class="form-control" id="inputTitle" placeholder="">
                            <span data-field="title" class="invalid-feedback"></span>
                        </div>
                        <div class="form-group">
                            <label for="inputLink">Link</label>
                            <input type="text" name="link" class="form-control" id="inputLink" placeholder="">
                            <span data-field="link" class="invalid-feedback"></span>
                        </div>
                        <div class="form-group show-uploaded-file-name show-uploaded-file-preview">
                            <label>Icon</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="icon" class="custom-file-input" id="iconImage">
                                    <label class="custom-file-label" for="exampleInputFile"></label>
                                </div>
                            </div>
                            <div class="input-product-img-wrpr">
                                <img class="custom-file-preview" src="" style="max-height: 20px" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer btns-wrap">
                        <button type="submit" class="{{--btn btn-success--}} operation-button button button-sm button-primary">
                            Add
                        </button>
                        <button type="button" class="btn btn-danger operation-button-cancel" style="display: none;">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $menu->name }}</h3>
                    <div class="btns-wrap float-right">
                        <button type="button" id="SaveSort" disabled class="<!--btn btn-success--> button button-sm button-primary">Save Sort</button>
                        <button type="button" id="CancelSort" style="display: none;" class="<!--btn btn-danger--> button button-sm button-default">Cancel</button>
                    </div>
                </div>
                <div class="card-body" id="cont">
                    <ul id="sortable" class="sortable list-group main-sort-list">
                        <x-admin.menu-items-sortable :menu="$menu" />
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        var items = {};

        @foreach ($menu->itemsAll as $item)
            items[{{$item->id}}] = {
                sort: {{ $item->sort }},
                title: '{!! $item->title !!}',
                link: '{{ $item->link }}',
                icon: '{{ $item->icon }}',
                @if (!is_null($item->parent_id))
                    parent: {{ $item->parent_id }},
                @endif
            };
        @endforeach
    </script>
    <script src="{{asset('/js/admin/menus.js')}}"></script>
@endpush

@push('styles')
    <style>
        .list-group{
            border: none;
        }
        .list-group-item {
            position: relative;
            display: block;
            padding: 0.75rem 1.25rem;
            background-color: #fff;
            border: 1px solid rgba(0,0,0,.125);
        }
        .btn-default {
            background-color: #f8f9fa;
            border-color: #ddd;
            color: #444;
        }
        .remove-item{
            color: #fff;
            background-color: #c82333;
            border-color: #bd2130;
        }
        .operation-button-cancel {
            color: #fff;
            background-color: #c82333;
            border-color: #bd2130;
        }
    </style>
@endpush
