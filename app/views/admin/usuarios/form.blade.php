@extends('layouts.masterAdmin')
@if(isset($title))
	@section('title')
		{{ $title }}
	@stop
@endif

@section('content')

		<?php  $disabled=(!empty($view))?'disabled':''; ?>

@if(isset($item->id))     
	{{ Form::open(array('url' => 'admin/'.$file .'/edit', 'class'=>'form-horizontal', 'role'=>'form', 'files' => true)) }}
@else
	{{ Form::open(array('url' => 'admin/'.$file .'/create', 'class'=>'form-horizontal', 'role'=>'form', 'files' => true)) }}
@endif

		<div class="form-group">
			{{ Form::label('usuario', 'Usuario', array('class' => 'col-sm-2 control-label')) }}
			<div class="col-xs-4">
				{{ Form::text('usuario',(isset($item->usuario))?$item->usuario:'', array('class' => 'form-control','style'=>'width:205px',$disabled)) }}
			
			</div>
		</div>
		<div class="form-group">
			{{ Form::label('pass', 'Password', array('class' => 'col-sm-2 control-label')) }}
			<div class="col-xs-3">
				{{ Form::password('pass', array('class' => 'form-control','type' => 'password','style'=>'width:205px',$disabled)) }}
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label" for="role"></label>
			<div class="col-xs-4">
				@if(isset($item->id))
					{{ Form::hidden('id', $item->id) }}
				<?php if(empty($view)){ ?>{{ Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Save', array('type' => 'submit', 'class' => 'btn btn-primary'))}} <?php  } ?>
				{{ HTML::decode(HTML::link('admin/'.$file .'/', '<i class="glyphicon glyphicon-circle-arrow-left"></i> Back', array('class' => 'btn btn-success'))); }}

				@else
				{{ Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Create', array('type' => 'submit', 'class' => 'btn btn-primary'))}}
				{{ HTML::decode(HTML::link('admin/'.$file .'/', '<i class="glyphicon glyphicon-circle-arrow-left"></i> Back', array('class' => 'btn btn-success'))); }}
				@endif
				
			</div>
		</div>
	{{ Form::close() }}

@stop

