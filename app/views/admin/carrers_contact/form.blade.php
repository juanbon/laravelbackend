@extends('layouts.masterAdmin')
@if(isset($title))
	@section('title')
		{{ $title }}
	@stop
@endif

@section('content')

@if(isset($item->id))
	{{ Form::open(array('url' => 'admin/users/edit', 'class'=>'form-horizontal', 'role'=>'form')) }}
@else
	{{ Form::open(array('url' => 'admin/users/create', 'class'=>'form-horizontal', 'role'=>'form')) }}
@endif
		<div class="form-group">
			{{ Form::label('user', 'User', array('class' => 'col-sm-2 control-label')) }}
			<div class="col-xs-4">
				{{ Form::text('user',(isset($item->user))?$item->user:'', array('class' => 'form-control')) }}
			
			</div>
		</div>
		<div class="form-group">
			{{ Form::label('name', 'Name', array('class' => 'col-sm-2 control-label')) }}
			<div class="col-xs-4">
				{{ Form::text('name', (isset($item->name))?$item->name:'', array('class' => 'form-control')) }}
			</div>
		</div>
		<div class="form-group">
			{{ Form::label('last_name', 'Last Name', array('class' => 'col-sm-2 control-label')) }}
			<div class="col-xs-4">
				{{ Form::text('last_name', (isset($item->last_name))?$item->last_name:'', array('class' => 'form-control')) }}
			</div>
		</div>
		<div class="form-group">
				{{ Form::label('country', 'Country', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-xs-4">
					{{ Form::select('country', $country, (isset($item->country))?$item->country:'', array('class' => 'form-control')); }}
				</div>
			</div>		
		<div class="form-group">
			{{ Form::label('email', 'Email', array('class' => 'col-sm-2 control-label')) }}
			<div class="col-xs-4">
				{{ Form::text('email', (isset($item->email))?$item->email:'', array('class' => 'form-control')) }}
			</div>
		</div>
		<div class="form-group">
			{{ Form::label('picture', 'Picture', array('class' => 'col-sm-2 control-label')) }}
			<div class="col-xs-4">
				{{ Form::text('picture', (isset($item->picture))?$item->picture:'', array('class' => 'form-control')) }}
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="role"></label>
			<div class="col-xs-4">
				@if(isset($item->id))
					{{ Form::hidden('id', $item->id) }}
					{{ Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Edit', array('type' => 'submit', 'class' => 'btn btn-primary btn-block'))}}
				@else
					{{ Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Create', array('type' => 'submit', 'class' => 'btn btn-primary btn-block'))}}
				@endif
				
			</div>
		</div>
	{{ Form::close() }}
@stop

