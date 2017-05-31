@extends('layouts.masterAdmin')
@if(isset($title))
	@section('title')
		{{ $title }}
	@stop
@endif

@section('content')

		<?php  $disabled=(!empty($view))?'disabled':''; ?>

@if(isset($item->id))     
	{{ Form::open(array('url' => 'admin/releases/edit', 'class'=>'form-horizontal', 'role'=>'form', 'files' => true)) }}
@else
	{{ Form::open(array('url' => 'admin/releases/create', 'class'=>'form-horizontal', 'role'=>'form', 'files' => true)) }}
@endif

		<div class="form-group">
			{{ Form::label('title', 'Title', array('class' => 'col-sm-2 control-label')) }}
			<div class="col-xs-4">
				{{ Form::text('title',(isset($item->title))?$item->title:'', array('class' => 'form-control',$disabled)) }}
			
			</div>
		</div>
		<div class="form-group">
			{{ Form::label('sub_title', 'Subtitle', array('class' => 'col-sm-2 control-label')) }}
			<div class="col-xs-4">
				{{ Form::text('sub_title', (isset($item->sub_title))?$item->sub_title:'', array('class' => 'form-control',$disabled)) }}
			</div>
		</div>

		<div class="form-group">
				{{ Form::label('description', 'Description', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-xs-4">
					<?php if(!empty($view)){
							echo $item->description;
					}else{ ?>
						{{ Form::textarea('description',(isset($item->description))?$item->description:'', array('class' => 'form-control','id'=>'description')); }}
					<?php }?>
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
	            	{{HTML::image('public/upload/'.$file.'/'.$item->image,'',array('width'=>'360px','height'=>'200px','id'=>'image_releases'))}} 
	      
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
			{{ Form::label('date_event', 'Date Event', array('class' => 'col-sm-2 control-label')) }}
			<div class="col-xs-4">
				{{ Form::text('date_event', (isset($item->date_event))?$item->date_event:'', array('class' => 'form-control',$disabled)) }}
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('video', 'Video', array('class' => 'col-sm-2 control-label')) }}
			<div class="col-xs-4">

				<?php if(!empty($view)){ ?>  	

				<iframe width="420" height="315" src="//www.youtube.com/embed/<?php echo $item->video; ?>" frameborder="0" allowfullscreen></iframe>

				<?php }else{ ?>

				{{ Form::text('video', (isset($item->video))?'http://www.youtube.com/watch?v='.$item->video:'', array('class' => 'form-control','placeholder'=>'Enter URL from youtube')) }}
				<?php }?>
					</div>      
				</div>

		<div class="form-group">
			<label class="col-sm-2 control-label" for="role"></label>
			<div class="col-xs-4">
				@if(isset($item->id))
					{{ Form::hidden('edited_image', $item->image) }}
					{{ Form::hidden('id', $item->id) }}
				<?php if(empty($view)){ ?>{{ Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Save', array('type' => 'submit', 'class' => 'btn btn-primary'))}} <?php  } ?>
				{{ HTML::decode(HTML::link('admin/releases/', '<i class="glyphicon glyphicon-circle-arrow-left"></i> Back', array('class' => 'btn btn-success'))); }}

				@else
				{{ Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Create', array('type' => 'submit', 'class' => 'btn btn-primary'))}}
				{{ HTML::decode(HTML::link('admin/releases/', '<i class="glyphicon glyphicon-circle-arrow-left"></i> Back', array('class' => 'btn btn-success'))); }}
				@endif
				
			</div>
		</div>
	{{ Form::close() }}
	<script>

	<?php echo (!empty($ckeditor))?"make_editor('description');":'';  ?>

	$(function () {

			$("#delete_image").on("click",function(){

				 $("#image_releases").hide();
				 $("#delete_image").hide();
				 $("#box_upload_image").show();
				 $("input[name|='edited_image']").val("");

			})

	});

	$(function () {
            $("#date_event").datepicker({

            	dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true,
                yearRange: 'c-100:c',
                showButtonPanel: true,
                onChangeMonthYear:function(y, m, i){
                  var d = i.selectedDay;
                  $(this).datepicker('setDate', new Date(y, m - 1, d));
                 }
            });
            $.datepicker._selectDateOverload = $.datepicker._selectDate;

            $.datepicker._selectDate = function(id, dateStr) {
                var target = $(id);
                var inst = this._getInst(target[0]);
                inst.inline = true;
                $.datepicker._selectDateOverload(id, dateStr);
                inst.inline = false;
                this._updateDatepicker(inst);   
            }
$("#date_event").datepicker("setDate", new Date());

        });
	</script>
@stop

