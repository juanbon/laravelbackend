@extends('layouts.masterAdmin')
@if(isset($title))
	@section('title')
		{{ $title }}
	@stop
@endif

@section('search')
	{{ Form::open(array('url' => 'admin/campaigns/list', 'class'=>'form-group navbar-form navbar-right')) }}
		{{ Form::select('order', array(
			'id'	 		=> 'Id',
			'title' 	    => 'Title',
			'sub_title'     => 'SubTitle',
			'date_event' 	=> 'Date Event',			
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
	@if($access->campaigns->create)
		{{ HTML::decode(HTML::link('admin/campaigns/create/', '<i class="glyphicon glyphicon-user"></i> Create New', array('class' => 'btn btn-small btn-default'))); }}
	@endif
	@if($access->campaigns->export)
		{{ HTML::decode(HTML::link('admin/campaigns/export/', '<i class="glyphicon glyphicon-file"></i> Export', array('class' => 'btn btn-small btn-default pull-right'))); }}
	@endif
</div>

<div class="bs-example clear">
	<table class="table table-striped table-bordered">
	  <thead>
	    <tr>
	      <th>#</th>
	      <th>Title</th>
	      <th>SubTitle</th>
	      <th>Description</th>
	      <th>Image</th>
	      <th>Date Event</th>
	      <th>Date</th>
	      <th>Actions</th>
	    </tr>
	  </thead>
	  <tbody>
	  	@foreach($items as $item)
	        <tr>
				<td>{{$item->id}}</td>
				<td>{{$item->title}}</td> 
				<td>{{$item->sub_title}}</td>
			 	<td><?php
			 	 $description = strip_tags($item->description); if (strlen($description) > 50){
			 	 $ret = explode("\n", wordwrap($description, 50));
                 echo $ret[0] . " ..."; }else{ echo trim(strip_tags($item->description));} 
                 ?>
			 	</td>
				<td>{{HTML::image('public/upload/'.$file.'/'.$item->image,'',array('width'=>'80px','height'=>'50px'))}} </td>
				<td><?php $t=explode(" ",$item->date_event);?>{{$t[0]}}</td>
				<td><?php $y=explode(" ",$item->created_at);?>{{$y[0]}}</td>
				<td width="150px" align="center">
					@if($access->campaigns->create)
						{{ HTML::decode(HTML::link('admin/campaigns/slider/'.$type.'/'.$item->id, '<i class="glyphicon glyphicon-picture"></i>', array('class' => 'btn btn-warning','title'=>'Slider'))); }}
					@endif
					@if($access->campaigns->view)
						{{ HTML::decode(HTML::link('admin/campaigns/view/'.$item->id, '<i class="glyphicon glyphicon-search"></i>', array('class' => 'btn btn-small btn btn-primary','title'=>'View'))); }}
					@endif
					@if($access->campaigns->edit)
						{{ HTML::decode(HTML::link('admin/campaigns/edit/'.$item->id, '<i class="glyphicon glyphicon-edit"></i>', array('class' => 'btn btn-small btn btn-success','title'=>'Edit'))); }}
					@endif
					@if($access->campaigns->delete)
						{{ HTML::decode(HTML::link('admin/campaigns/delete/'.$item->id, '<i class="glyphicon glyphicon-trash"></i>', array('class' => 'btn btn-small btn-danger delete-btn','title'=>'Delete'))); }}
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