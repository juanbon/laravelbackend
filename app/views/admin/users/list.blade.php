@extends('layouts.masterAdmin')
@if(isset($title))
	@section('title')
		{{ $title }}
	@stop
@endif

@section('search')
	{{ Form::open(array('url' => 'admin/users/list', 'class'=>'form-group navbar-form navbar-right')) }}
		{{ Form::select('order', array(
			'id'	 		=> 'Id',
			'user' 			=> 'User',
			'name' 			=> 'Name',
			'last_name'		=> 'Last Name',
			'email' 		=> 'Email'
			), Input::get('order'), array('class' => 'form-control')) 
		}}
		{{ Form::select('orderby', array(
			'desc' 			=> 'Desc',
			'asc'	 		=> 'Asc'
			), Input::get('orderby'), array('class' => 'form-control')) 
		}}
		{{ Form::select('limit', array(
			'10'	 		=> 'Limit (10)',
			'50' 			=> '50',
			'100' 			=> '100',
			'1000' 			=> '1000',
			$totalItems 	=> 'All'
			), Input::get('limit'), array('class' => 'form-control')) 
		}}
		{{ Form::text('search', Input::get('search'), array('class' => 'form-control', 'placeholder'=>'Search...')) }}
		{{ Form::button('<i class="glyphicon glyphicon-search"></i> Filter', array('type' => 'submit', 'class' => 'btn btn-success'))}}
	{{ Form::close() }}
@stop


@section('content')

<div class="lead">
@if($access->users->create)
		{{ HTML::decode(HTML::link('admin/users/create/', '<i class="glyphicon glyphicon-user"></i> Create User', array('class' => 'btn btn-small btn-default'))); }}
	@endif

	@if($access->users->export)
		{{ HTML::decode(HTML::link('admin/users/export/', '<i class="glyphicon glyphicon-file"></i> Export', array('class' => 'btn btn-small btn-default pull-right'))); }}
	@endif
</div>

<div class="bs-example clear">
	<table class="table table-striped table-bordered">
	  <thead>
	    <tr>
	      <th>#</th>
	      <th>User</th>
	      <th>Name</th>
	      <th>Last Name</th>
	      <th>Email</th>
	      <th>Picture</th>
	      <th>Actions</th>
	    </tr>
	  </thead>
	  <tbody>
	  	@foreach($items as $item)
	        <tr>
				<td>{{$item->id}}</td>
				<td>{{$item->user}}</td>
				<td>{{$item->name}}</td>
				<td>{{$item->last_name}}</td>
				<td>{{$item->email}}</td>
				<td><a href="{{$item->picture}}" rel="popover" data-content="<img src='{{$item->picture}}' width='180'/>" data-title="Image preview" target="_blank" data-html=true><i class="glyphicon glyphicon-picture"></i></a></td>
				<td width="150px" align="center"><?php $class = ($item->visible)?"btn-warning":"btn-default"; ?>
					@if($access->users->edit)
						{{ HTML::decode(HTML::link('admin/users/visible/'.$item->id, '<i class="glyphicon glyphicon-eye-open"></i>', array('class' => 'btn btn-small '.$class.''))); }}
						{{ HTML::decode(HTML::link('admin/users/edit/'.$item->id, '<i class="glyphicon glyphicon-pencil"></i>', array('class' => 'btn btn-small btn-primary edit-btn'))); }}
					@endif
					@if($access->users->delete)
						{{ HTML::decode(HTML::link('admin/users/delete/'.$item->id, '<i class="glyphicon glyphicon-trash"></i>', array('class' => 'btn btn-small btn-danger delete-btn'))); }}
					@endif
				</td>
	        </tr>
	    @endforeach
	  </tbody>
	</table>
</div><!-- /example -->


<div class="center-text">
{{$items->appends(array('search' => Input::get('search'), 'limit' => Input::get('limit'), 'order' => Input::get('order'), 'orderby' => Input::get('orderby')))->links()}}
</div>
@stop