@extends('layouts.admin.app')

@section('title', 'Feedbacks')

@section('content_header')
    <x-admin.title
        text="Feedbacks"
        bcRoute="admin.feedbacks.index"
    />
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <table id="feedbacks-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="ids-column">ID</th>
                                <th>User</th>
                                <th>Email</th>
                                <th>Title</th>
                                <th>Created at</th>
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
    <script src="{{asset('/js/admin/feedbacks.js')}}"></script>
@endpush
