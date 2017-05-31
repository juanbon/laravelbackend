@extends('layouts.masterAdmin')
@if(isset($title))
	@section('title')
		{{ $title }}
	@stop
@endif

@section('content')

@if(isset($item->id))
	{{ Form::open(array('url' => 'admin/admins/edit', 'class'=>'form-horizontal', 'role'=>'form')) }}
@else
	{{ Form::open(array('url' => 'admin/admins/create', 'class'=>'form-horizontal', 'role'=>'form')) }}
@endif
		<div class="form-group">
			{{ Form::label('user', 'User', array('class' => 'col-sm-2 control-label')) }}
			<div class="col-xs-4">
			  @if(isset($item->id))
				<p class="form-control-static">{{ (isset($item->user))?$item->user:'' }}</p>
			  @else
				{{ Form::text('user','', array('class' => 'form-control')) }}
			  @endif
			</div>
		</div>
		<div class="form-group">
			{{ Form::label('email', 'email', array('class' => 'col-sm-2 control-label')) }}
			<div class="col-xs-4">
				{{ Form::text('email', (isset($item->email))?$item->email:'', array('class' => 'form-control')) }}
			</div>
		</div>
		<div class="form-group">
			{{ Form::label('picture', 'picture', array('class' => 'col-sm-2 control-label')) }}
			<div class="col-xs-4">
				{{ Form::text('picture', (isset($item->picture))?$item->picture:'', array('class' => 'form-control')) }}
			</div>
		</div>
		<div class="form-group">
			{{ Form::label('password', 'Password', array('class' => 'col-sm-2 control-label')) }}
			<div class="col-xs-4">
				{{ Form::password('password', array('class' => 'form-control', 'autocomplete' => 'off')) }}
			</div>
		</div>
		<div class="form-group">
			{{ Form::label('repeatpassword', 'Repeat Password', array('class' => 'col-sm-2 control-label')) }}
			<div class="col-xs-4">
				{{ Form::password('repeatpassword', array('class' => 'form-control', 'autocomplete' => 'off')) }}
			</div>
		</div>
			@if($adminData->role == 'sadmin')
			<div class="form-group">
				{{ Form::label('role', 'Role', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-xs-4">
					{{ Form::select('role', array('sadmin' => 'Super Administrator', 'admin' => 'Administrator'), (isset($item->role))?$item->role:'admin', array('class' => 'form-control')); }}
				</div>
			</div>

			<div class="form-group">
				{{ Form::label('role', 'Users', array('class' => 'col-sm-2 control-label')) }}			
				<div class="col-xs-4">
					<label class="checkbox-inline">
						{{ Form::checkbox('users[view]', '1', (isset($item) && property_exists($item->access, 'users'))?$item->access->users->view:false) }} View
					</label>
					<label class="checkbox-inline">
						{{ Form::checkbox('users[edit]', '1', (isset($item) && property_exists($item->access, 'users'))?$item->access->users->edit:false) }} Edit
					</label>
					<label class="checkbox-inline">
						{{ Form::checkbox('users[create]', '1', (isset($item) && property_exists($item->access, 'users'))?$item->access->users->create:false) }} Create
					</label>
					<label class="checkbox-inline">
						{{ Form::checkbox('users[delete]', '1', (isset($item) && property_exists($item->access, 'users'))?$item->access->users->delete:false) }} Delete
					</label>					
					<label class="checkbox-inline">
						{{ Form::checkbox('users[export]', '1', (isset($item) && property_exists($item->access, 'users'))?$item->access->users->export:false) }} Export
					</label>
				</div>
			</div>

			<div class="form-group">
				{{ Form::label('role', 'Admin', array('class' => 'col-sm-2 control-label')) }}			
				<div class="col-xs-4">
					<label class="checkbox-inline">
						{{ Form::checkbox('admin[view]', '1', (isset($item) && property_exists($item->access, 'admin'))?$item->access->admin->view:false) }} View
					</label>
					<label class="checkbox-inline">
						{{ Form::checkbox('admin[edit]', '1', (isset($item) && property_exists($item->access, 'admin'))?$item->access->admin->edit:false) }} Edit
					</label>
					<label class="checkbox-inline">
						{{ Form::checkbox('admin[create]', '1', (isset($item) && property_exists($item->access, 'admin'))?$item->access->admin->create:false) }} Create
					</label>
					<label class="checkbox-inline">
						{{ Form::checkbox('admin[delete]', '1', (isset($item) && property_exists($item->access, 'admin'))?$item->access->admin->delete:false) }} Delete
					</label>					
					<label class="checkbox-inline">
						{{ Form::checkbox('admin[export]', '1', (isset($item) && property_exists($item->access, 'admin'))?$item->access->admin->export:false) }} Export
					</label>
				</div>
			</div>		
			@endif
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

