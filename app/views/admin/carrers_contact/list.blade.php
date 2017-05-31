@extends('layouts.masterAdmin')
@if(isset($title))
	@section('title')
		{{ $title }}
	@stop
@endif

@section('search')
	{{ Form::open(array('url' => 'admin/contact/list', 'class'=>'form-group navbar-form navbar-right')) }}
		{{ Form::select('order', array(
			'id'	 		=> 'Id',
			'first_name' 	=> 'Name',
			'area' 			=> 'Area',
			'city' 	    	=> 'City',			
			'state' 		=> 'State',
			'email' 	    => 'Email',
			'created_at'    => 'Date'								
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

	@if($access->carrers_con->export)
		{{ HTML::decode(HTML::link('admin/contact/export/', '<i class="glyphicon glyphicon-file"></i> Export', array('class' => 'btn btn-small btn-default pull-right'))); }}
	@endif
</div>

<div class="bs-example clear">
	<table class="table table-striped table-bordered">
	  <thead>
	    <tr>
	      <th>#</th>
	      <th>Name</th>
	      <th>Area</th>
	      <th>City</th>
	      <th>State</th>
	      <th>Email</th>
	      <th>File</th>
	      <th>Date</th>
	      <th>Actions</th>
	    </tr>
	  </thead>
	  <tbody>
	  	@foreach($items as $item)
	        <tr>
				<td>{{$item->id_contact}}</td>
				<td>{{$item->contact_name.' '.$item->last_name}}</td> 
				<td>{{$item->type_job}}</td>
			 	<td>{{$item->city}}</td>
				<td>{{$item->contact_state}}</td>
				<td>{{$item->email}}</td>
				<td>   
				 @if(is_file('./public/upload/contact/'.$item->file.'.'.$item->file_type))
				 {{ HTML::decode(HTML::link('admin/contact/download/'.$item->file, '<span class="glyphicon glyphicon-download btn-lg"></span>')); }}
				 @endif
				</td>
				<td>{{$item->contact_date}}</td>
				<td width="150px" align="center">
					@if($access->carrers_con->delete)
						{{ HTML::decode(HTML::link('admin/contact/delete/'.$item->id_contact, '<i class="glyphicon glyphicon-trash"></i>', array('class' => 'btn btn-small btn-danger delete-btn'))); }}
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