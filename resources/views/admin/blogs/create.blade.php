@extends('layouts.admin.app')

@section('title', 'Create blog')

@section('content_header')
    <x-admin.title
        text="Create blog"
        bcRoute="admin.blogs.create"
    />
@stop

@section('content')
    <form action="{{ route('admin.blogs.store') }}" method="POST" class="general-ajax-submit">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center mb-4 user-image-block">
                    <label class="uploader mr-3 show-uploaded-file-preview">
                        <input type="file" name="thumbnail" class="sr-only" id="file">
                        <img src="" class="custom-file-preview" alt="" style="width: 400px">
                    </label>
                    <button type="button" class="btn btn-default" data-trigger="#file">Set Thumbnail</button>
                    <span data-input="thumbnail" class="input-error"></span>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Title</label>
                            <x-admin.multi-lang-input name="title" />
                            <span data-input="title" class="input-error"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Slug</label>
                            <x-admin.multi-lang-input name="slug" />
                            <span data-input="slug" class="input-error"></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Content</label>
                            <x-admin.multi-lang-input name="content" :textarea="true" />
                            <span data-input="content" class="input-error"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5 class="m-0">
                    Slider images
                    <button type="button" class="btn btn-success add-image-input">Add</button>
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 image-input d-none clone">
                        <div class="form-group show-uploaded-file-preview">
                            <input type="file" class="form-control" name="images[]">
                            <img src="" class="custom-file-preview" alt="" style="width: 200px">
                            <button type="button" class="btn btn-warning delete-image-input">Remove</button>
                        </div>
                    </div>
                    <div class="col-md-4 image-input">
                        <div class="form-group show-uploaded-file-preview">
                            <input type="file" class="form-control" name="images[]">
                            <img src="" class="custom-file-preview" alt="" style="width: 200px">
                            <button type="button" class="btn btn-warning delete-image-input">Remove</button>
                        </div>
                    </div>
                    <span data-input="image" class="input-error"></span>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success min-w-100">Save</button>
        <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline-secondary text-dark min-w-100">Cancel</a>
    </form>
@endsection

@push('scripts')
    <script src="{{asset('/js/admin/blogs.js')}}"></script>
@endpush
