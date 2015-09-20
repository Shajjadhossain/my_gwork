@extends('layouts.layout')
@section('content')
    {{-- Data Tables filter js --}}
    {{ HTML::script('asset/js/jquery.dataTables.min.js')}}
    {{ HTML::style('asset/css/jquery.dataTables.min.css') }}

    <div style="border: 1px solid #0077b3; text-align: center; margin: 20px 0px;">
        <h1> My <small> First Laravel Application </small> </h1>
    </div>

    <!-- will be used to show any messages -->
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    <p>
        {{-- Add employee button --}}
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"> Add Employee </button>
        {{-- Gallery --}}
        <a href="{{ URL::route('employees.gallery') }}"  class="btn btn-success" >Gallery</a>
    </p>

    <script>
        $(document).ready(function() {
            $('#employeeData').DataTable({
                "paging":   false,
                "oLanguage": {
                    "sSearch": "Filter _INPUT_ ",
                    "sInfoFiltered": " - filtered from ( _MAX_ ) items"
                }
            });
            $(".checkBox").change(function() {
                if(this.checked) {
                    $('.myCheckBox').prop('checked', true);
                    $("#hide-button").show();
                }
                if(!this.checked) {
                    $('.myCheckBox').prop('checked', false);
                    $("#hide-button").hide();
                }
            });
            $(".myCheckBox").change(function() {
                if(this.checked) {
                    $("#hide-button").show();
                }
                if(!this.checked) {
                    $("#hide-button").hide();
                }
            });
            $('#confirm-delete').on('show.bs.modal', function(e) {
                $(this).find('.danger').attr('href', $(e.relatedTarget).data('href'));
                $('.debug-url').html('Delete URL: <strong>' + $(this).find('.danger').attr('href') + '</strong>');
            })
        } );
    </script>

    {{--<div class="search">
        {{ Form::model(null, array('route' => array('employees.search'))) }}
        {{ Form::text('query', null, array('class' => 'form-control', 'placeholder' => 'Search query...', 'required'=>'required' )) }}
        {{ Form::submit('Search', array('class'=>"btn btn-success")) }}
        {{ Form::close() }}
    </div>--}}

    {{--Start Data Grid View--}}
    {{ Form::open(['route' => ['employees.massDelete']]) }}
    <table id="employeeData" class="display table-bordered" class="table table-hover">
        <thead>
        <tr>
            <th><input type="checkbox" class="checkBox"></th>
            <th>ID </th>
            <th>First Name </th>
            <th>Last Name </th>
            <th>Email </th>
            <th>Photo </th>
            <th>Action </th>
        </tr>
        </thead>

        <tbody>
        @foreach($employees as $data)
            <tr>

                <td><input type="checkbox" name="id[]" class="myCheckBox" value="{{$data->id}}"> </td>
                <td>{{$data->id}} </td>
                <td>{{$data->first_name}} </td>
                <td>{{$data->last_name}} </td>
                <td>{{$data->email}} </td>
                <td>{{HTML::image($data->photo, $data->first_name, array('width'=>'50'))}} </td>
                <td>
                    <a title="Show" href="{{ URL::route('employees.show', $data->id) }}" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-eye-open"> </span></a>
                    <a title="Modify" href="{{ URL::route('employees.edit', $data->id) }}" class="btn " data-toggle="modal" data-target="#editModal"><span class="glyphicon glyphicon-edit"></span></a> &nbsp;
                    <a data-href="{{ URL::route('employees.destroy', $data->id) }}" class="text-danger" title="Delete" data-toggle="modal" data-target="#confirm-delete" href="" ><span class="glyphicon glyphicon-trash"></span></a>

                </td>
            </tr>
        @endforeach

        </tbody>

    </table><br>
    {{ Form::submit( 'Batch Delete', ['class'=>"btn btn-danger", 'id'=>'hide-button', 'onclick'=>"return confirm('Are you sure to Delete?')"]) }}
    {{ Form::close() }}


    <div class="pagination-tool">
        <div class="paginate-area">
            Displaying <span style="color: red"> {{$viewCount}} </span> of {{$countAll}} entries.
        </div>
        <div class="paginate-button">
            {{$employees->links()}}
        </div>
    </div>
    {{--End Data Grid View--}}


    <!-- Modal :: Delete Confirmation -->
    <div class="modal fade " id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="confirm-delete" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
                </div>
                <div class="modal-body">
                    <strong>Are you sure to delete?</strong>
                </div>
                <div class="modal-footer">
                    {{--<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>--}}
                    <a href="{{ URL::route('employees.index') }}"  class="btn btn-default" >Cancel</a>
                    <a href="#" class="btn btn-danger danger">Delete</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Add New Employee -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add New Employee</h4>
                </div>
                <div class="modal-body">
                    {{ Form::open(['route' => ['employees.store'], 'files' => TRUE,]) }}
                    @include('employee._form')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Employee -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>


@stop
