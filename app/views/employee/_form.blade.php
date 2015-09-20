<div>
    {{ Form::label('first_name', 'First Name') }}
    {{ Form::text('first_name', null, array('class' => 'form-control','required'=>'required')) }}
    @if ($errors->has('first_name')) <p class="help-block" >{{ $errors->first('first_name') }}</p> @endif
</div>
<div>
    {{ Form::label('last_name', 'Last Name') }}
    {{ Form::text('last_name', null, array('class' => 'form-control','required'=>'required') ) }}
    @if ($errors->has('last_name')) <p class="help-block" >{{ $errors->first('last_name') }}</p> @endif
</div>

<div>
    {{ Form::label('email', 'Email Address') }}
    {{ Form::text('email', null, array('class' => 'form-control','required'=>'required')) }}
    @if ($errors->has('email')) <p class="help-block" >{{ $errors->first('email') }}</p> @endif
</div>

<div>
    {{ Form::label('photo', 'Photo') }}
    {{--{{ Form::file('photo[]',array('multiple'=>true, 'required'=>true)) }}--}}
    {{ Form::file('photo') }}

</div>

<p> &nbsp;</p>
<div>
    {{ Form::submit( 'Save', ['class'=>"btn btn-success"]) }}
    <a href="{{ URL::route('employees.index') }}"  class="btn btn-default" >Cancel</a>
    {{--<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>--}}
</div>