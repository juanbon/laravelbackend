@extends('layouts.masterAdmin')
@if(isset($title))
	@section('title')
		{{ ucfirst($section)." ".$title }}
	@stop
@endif


@section('search')
	{{ Form::open(array('url' => 'admin/'.$section.'/slider/'.$type.'/'.$id_theme.'/list/', 'class'=>'form-group navbar-form navbar-right')) }}
		{{ Form::select('order', array(
			'id'	 		=> 'Id',		
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
	@if($access->$section->create)
		{{ HTML::decode(HTML::link('admin/'.$section.'/slider/'.$type.'/'.$id_theme.'/create/', '<i class="glyphicon glyphicon-user"></i> New Image', array('class' => 'btn btn-small btn-default'))); }}
	@endif
	@if($access->$section->export)
		{{ HTML::decode(HTML::link('admin/'.$section.'/slider/'.$type.'/'.$id_theme.'/export/', '<i class="glyphicon glyphicon-file"></i> Export', array('class' => 'btn btn-small btn-default pull-right'))); }}
	@endif

	{{ HTML::decode(HTML::link('admin/'.$section.'/slider/'.$type.'/'.$id_theme.'/sorting/', '<i class="glyphicon glyphicon-user"></i> Sorting', array('class' => 'btn btn-small btn-default'))); }}

</div>  


<div class="bs-example clear">
	<table class="table table-striped table-bordered">
	  <thead>
	    <tr>
	      <th>#</th>
	      <th>Name Image</th>
	      <th>Image</th>
	      <th>Date</th>
	      <th>Actions</th>
	    </tr>
	  </thead>
	  <tbody>
	  	@foreach($items as $item)
	        <tr>
				<td>{{$item->id}}</td>
				<td>{{$item->image}}</td> 


				<td>{{HTML::image('public/upload/'.$section.'/slider/'.$item->image,'',array('width'=>'80px','height'=>'50px'))}} </td>

				<td><?php $y=explode(" ",$item->created_at);?>{{$y[0]}}</td>
				<td width="150px" align="center">
					@if($access->$section->view)

					<a class="btn btn-small btn btn-primary" href="{{$item->picture}}" rel="popover" data-content="<img src='<?php echo url();?>/public/upload/{{$section}}/slider/{{$item->image}}' width='300'/>" data-title="Image preview" target="_blank" data-html=true><i class="glyphicon glyphicon-search"></i></a>

					@endif
					@if($access->$section->delete)
						{{ HTML::decode(HTML::link('admin/'.$section.'/slider/'.$type.'/'.$id_theme.'/delete/'.$item->id, '<i class="glyphicon glyphicon-trash"></i>', array('class' => 'btn btn-small btn-danger delete-btn','title'=>'Delete'))); }}
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