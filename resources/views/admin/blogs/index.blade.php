@extends('layouts.admin.app')

@section('title', 'Blogs')

@section('content_header')
    <x-admin.title
        text="Blogs"
        :button="['+ Add Blog', route('admin.blogs.create')]"
        bcRoute="admin.blogs.index"
    />
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <table id="blogs-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="ids-column">ID</th>
                                <th>Title</th>
                                <th>Content</th>
                                <th>Created_at</th>
                                <th class="actions-column-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{asset('/js/admin/blogs.js')}}"></script>
@endpush
