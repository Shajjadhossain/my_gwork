@extends('layouts.layout')
@section('content')
    <div class="page-header" style="border: 1px solid #0077b3;">
        <h1>Add New Employee </h1>
    </div>
    {{--Error handling--}}
    @if ( $errors->count() > 0 )
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $message )
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{--set some message after action--}}
    @if (Session::has('message'))
        <div>{{ Session::get('message') }}</div>
    @endif


    {{ Form::open(['route' => ['employees.store'], 'files' => TRUE,]) }}
    @include('employee._form')
    {{ Form::close() }}


@stop