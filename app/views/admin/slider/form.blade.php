@extends('layouts.masterAdmin')
@if(isset($title))
	@section('title')
		{{ $title }}
	@stop
@endif

@section('content')

		<?php  $disabled=(!empty($view))?'disabled':''; ?>

@if(isset($item->id))     
	{{ Form::open(array('url' => 'admin/news/edit', 'class'=>'form-horizontal', 'role'=>'form', 'files' => true)) }}
@else
	{{ Form::open(array('url' => 'admin/news/slider/'.$type.'/'.$id_theme.'/create', 'class'=>'form-horizontal', 'role'=>'form', 'files' => true)) }}
@endif

 <input type="button" value="+ Images" id="more_photos"> 

     	<div class="form-group">
			{{ Form::label('image', 'Image', array('class' => 'col-sm-2 control-label')) }}

			<div class="col-xs-4">
			{{ Form::file('image',array('accept'=>'image/*','name'=>'news_slider[]')) }}  
			</div> 
		</div>
            <div id="photo_box" name="photo_box" class="clearfix" style="width:100%;">
            </div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="role"></label>
			<div class="col-xs-4">

				{{ Form::hidden('type', $type) }} 
				{{ Form::hidden('id_theme', $id_theme) }} 
				{{ Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Add', array('type' => 'submit', 'class' => 'btn btn-primary'))}}
				{{ HTML::decode(HTML::link('admin/'.$section.'/slider/'.$type.'/'.$id_theme.'/list', '<i class="glyphicon glyphicon-circle-arrow-left"></i> Back', array('class' => 'btn btn-success'))); }}				
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
				});

					i=1;
					$('#more_photos').on('click', function(){
					i++;
					AgregarCampos(i);
						})
			});

		function AgregarCampos(i){

		campo = '<div class="form-group"><label class="col-sm-2 control-label" for="image">Image '+i+'</label><div class="col-xs-4"><input id="news_slider" type="file" name="news_slider[]" accept="image/*"></div></div>';

		$("#photo_box").append(campo);

		}

	</script>
@stop

