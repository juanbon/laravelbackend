@extends('layouts.masterAdmin')
@if(isset($title))
	@section('title')
		{{ $title }}
	@stop
@endif

@section('search')
	{{ Form::open(array('url' => 'admin/carrers_jobs/list', 'class'=>'form-group navbar-form navbar-right')) }}
		{{ Form::select('order', array(
			'id'	 		=> 'Id',
			'created_at'    => 'Date',
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
@if($access->carrers_jobs->create)
		{{ HTML::decode(HTML::link('admin/carrers_jobs/create/', '<i class="glyphicon glyphicon-user"></i> Create Job', array('class' => 'btn btn-small btn-default'))); }}
	@endif

	@if($access->carrers_jobs->export)
		{{ HTML::decode(HTML::link('admin/carrers_jobs/export/', '<i class="glyphicon glyphicon-file"></i> Export', array('class' => 'btn btn-small btn-default pull-right'))); }}
	@endif
</div>

<div class="bs-example clear">
	<table class="table table-striped table-bordered">
	  <thead>
	    <tr>
	      <th>#</th>
	      <th>Link</th>
	      <th>Image</th>
	      <th>Date</th>
	      <th>Actions</th>
	    </tr>
	  </thead>
	  <tbody>
	  	@foreach($items as $item)
	        <tr>
				<td>{{$item->id}}</td>
				<td>{{ HTML::link($item->link,null,array("target"=>"_blank")) }}</td>
				<td>{{HTML::image('public/upload/'.$file.'/'.$item->image,'',array('width'=>'80px','height'=>'50px'))}} </td>              
				<td>{{$item->created_at}}</td>
				<td width="150px" align="center"><?php $class = ($item->visible)?"btn-warning":"btn-default"; 
				$alt = ($item->visible)?"Visible":"Invisible"; 
				?>
					@if($access->carrers_jobs->edit)
						{{ HTML::decode(HTML::link('admin/carrers_jobs/visible/'.$item->id, '<i class="glyphicon glyphicon-eye-open"></i>', array('title'=>$alt,'class' => 'btn btn-small '.$class.''))); }}
						{{ HTML::decode(HTML::link('admin/carrers_jobs/edit/'.$item->id, '<i class="glyphicon glyphicon-pencil"></i>', array('class' => 'btn btn-small btn-primary edit-btn'))); }}
					@endif
					@if($access->carrers_jobs->delete)
						{{ HTML::decode(HTML::link('admin/carrers_jobs/delete/'.$item->id, '<i class="glyphicon glyphicon-trash"></i>', array('class' => 'btn btn-small btn-danger delete-btn'))); }}
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