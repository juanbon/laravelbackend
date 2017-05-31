@extends('layouts.masterAdmin')
@if(isset($title))
	@section('title')
		{{ $title }}
	@stop
@endif

@section('content')

<div class="lead">
	@if($access->news->create)
		{{ HTML::decode(HTML::link('admin/'.$file.'/create/', '<i class="glyphicon glyphicon-user"></i> Create New', array('class' => 'btn btn-small btn-default'))); }}
	@endif
</div>

<div class="bs-example clear">
	<table class="table table-striped table-bordered">
	  <thead>
	    <tr>
	      <th>#</th>
	      <th>Usuario</th>
	      <th>Accesos <br> Correctos</th>
	      <th>Accesos <br> Incorrectos</th>
	      <th>Actions</th>
	    </tr>
	  </thead>
	  <tbody>
	  	@foreach($items as $item)
	        <tr>
				<td>{{$item->id}}</td>
				<td>{{$item->user}}</td> 
				<td>{{$item->acceso_correcto}}</td> 
				<td>{{$item->acceso_incorrecto}}</td> 
				<td width="150px" align="center">
					@if($access->news->view)
						{{ HTML::decode(HTML::link('admin/'.$file.'/view/'.$item->id, '<i class="glyphicon glyphicon-search"></i>', array('class' => 'btn btn-small btn btn-primary','title'=>'View'))); }}
					@endif
					@if(($access->news->edit)AND($item->id!=1))
						{{ HTML::decode(HTML::link('admin/'.$file.'/edit/'.$item->id, '<i class="glyphicon glyphicon-edit"></i>', array('class' => 'btn btn-small btn btn-success','title'=>'Edit'))); }}
					@endif
					@if(($access->news->delete)AND($item->id!=1))
						{{ HTML::decode(HTML::link('admin/'.$file.'/delete/'.$item->id, '<i class="glyphicon glyphicon-trash"></i>', array('class' => 'btn btn-small btn-danger delete-btn','title'=>'Delete'))); }}
					@endif
				</td>
	        </tr>
	    @endforeach
	  </tbody>
	</table>
</div><!-- /example -->



@stop