@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="/css/admin/custom.css">
    @stack('styles')
@stop

@section('js')
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script src="/js/admin/custom.js"></script>
    @stack('scripts')
@stop
