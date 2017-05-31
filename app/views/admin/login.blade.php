@extends('layouts.masterAdmin')

@section('content')
	{{ Form::open(array('url' => 'admin/login', 'class'=>'form-signin')) }}
	{{ Form::label('user', 'User', array('class' => 'control-label')) }}
	{{ Form::text('user', '', array('class' => 'form-control')) }}
	{{ Form::label('password', 'Password', array('class' => 'control-label')) }}
	{{ Form::password('password', array('class' => 'form-control')) }}
	{{ Form::button('<i class="glyphicon glyphicon-log-in"></i> Enter', array('type' => 'submit', 'class' => 'btn btn-lg btn-primary btn-block'))}}
	{{ Form::close() }}
@stop