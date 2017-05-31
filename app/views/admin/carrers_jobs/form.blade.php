@extends('layouts.masterAdmin')

@if(isset($title))
	@section('title')
		{{ $title }}
	@stop
@endif
@section('content')  

@if(isset($item->id))
	{{ Form::open(array('url' => 'admin/carrers_jobs/edit', 'class'=>'form-horizontal', 'role'=>'form', 'files' => true)) }}
@else
	{{ Form::open(array('url' => 'admin/carrers_jobs/create', 'class'=>'form-horizontal', 'role'=>'form', 'files' => true)) }}
@endif
		<div class="form-group">
			{{ Form::label('link', 'Link', array('class' => 'col-sm-2 control-label')) }}
			<div class="col-xs-4">
				{{ Form::text('link',(isset($item->link))?$item->link:'', array('class' => 'form-control')) }}
			</div>
		</div>

     	<div class="form-group">
			{{ Form::label('image', 'Image', array('class' => 'col-sm-2 control-label')) }}
			<div class="col-xs-4">
			   <?php if(!empty($view)){ ?>
					{{HTML::image('public/upload/'.$file.'/'.$item->image,'',array('width'=>'360px','height'=>'200px'))}}
				<?php }else{ ?>

			<div class="col-xs-4">
	            <?php  if(!empty($item->image)){ ?> 
	            	{{HTML::image('public/upload/'.$file.'/'.$item->image,'',array('width'=>'360px','height'=>'200px','id'=>'image_news'))}} 
	      
					{{ Form::button('<i class="glyphicon glyphicon-trash"></i> ', array('type' => 'button', 'class' => 'btn btn-danger','id'=>'delete_image','style'=>'left: 376px;position: relative;top: -117px;'))}}
	
					<div id="box_upload_image" style="display:none">
			 			 {{ Form::file('image',array('accept'=>'image/*')) }}
					</div>
      				<?php  }else{ ?>
						 {{ Form::file('image',array('accept'=>'image/*')) }}
					<?php } ?>
			</div> 
				<?php }?>			 
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label" for="role"></label>
			<div class="col-xs-4">
				@if(isset($item->id))
					{{ Form::hidden('edited_image', $item->image) }}
					{{ Form::hidden('id', $item->id) }}
					{{ Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Edit', array('type' => 'submit', 'class' => 'btn btn-primary'))}}
				{{ HTML::decode(HTML::link('admin/carrers_jobs/', '<i class="glyphicon glyphicon-circle-arrow-left"></i> Back', array('class' => 'btn btn-success'))); }}
				@else
					{{ Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Create', array('type' => 'submit', 'class' => 'btn btn-primary'))}}
				{{ HTML::decode(HTML::link('admin/carrers_jobs/', '<i class="glyphicon glyphicon-circle-arrow-left"></i> Back', array('class' => 'btn btn-success'))); }}
				
				@endif
				
			</div>
		</div>
	{{ Form::close() }}
	<script>
		$(function () {

			$("#delete_image").on("click",function(){

				 $("#image_news").hide();
				 $("#delete_image").hide();
				 $("#box_upload_image").show();
				 $("input[name|='edited_image']").val("");

			})

	});

	</script>
@stop

