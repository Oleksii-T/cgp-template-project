@extends('layouts.admin.app')

@section('title', 'Feedback')

@section('content_header')
    <x-admin.title
        text="Feedback"
        :bcRoute="['admin.feedbacks.show', $feedback]"
    />
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>User</label>
                        @if ($feedback->user)
                            <a class="form-control" href="{{route('admin.users.edit', $feedback->user_id)}}">
                                {{$feedback->user->name}}
                            </a>
                        @else
                            <p class="form-control">-</p>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Email</label>
                        <p class="form-control">{{$feedback->email}}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Titile</label>
                        <p class="form-control">{{$feedback->title}}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Text</label>
                        <textarea class="form-control">{{$feedback->text}}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Created at</label>
                        <p class="form-control">{{$feedback->created_at->format(env('ADMIN_DATETIME_FORMAT'))}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a href="{{ route('admin.feedbacks.index') }}" class="btn btn-outline-secondary text-dark min-w-100">Cancel</a>
@endsection
