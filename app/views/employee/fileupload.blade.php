{{ Form::open(['route' => ['employees.upload'], 'files' => TRUE,]) }}
{{--{{ Form::open(array('action' => 'EmployeesController@upload', 'files'=>true)) }}--}}
{{ Form::label('photo', 'Upload photo')}}
{{ Form::file('photo[]', array('multiple'=>true)) }}
{{ Form::submit('Submit') }}
{{ Form::close() }}