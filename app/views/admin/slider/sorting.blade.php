@extends('layouts.masterAdmin')
@if(isset($title))
	@section('title')
		{{ 'Sorting '.$title.' '.ucfirst($section) }}
	@stop
@endif
@section('content')

	    <div class="row">
			<ul id="sortable" onmouseout="send()">
				@foreach($items as $item)
					<li class="li_or" rel="{{$item['id']}}" onclick="send()">
						{{HTML::image('public/upload/'.$section.'/slider/'.$item['image'],'',array('width'=>'140px','height'=>'80px'))}}
					</li>
				@endforeach
			</ul>
	    </div>

		{{ Form::open(array('url' => 'admin/news/slider/'.$type.'/'.$id_theme.'/sorting/', 'class'=>'form-horizontal', 'role'=>'form', 'files' => true)) }}

				{{ Form::hidden('type', $type)}}
				{{ Form::hidden('id_theme',$id_theme) }}

				{{ Form::hidden('sort', '',array('id'=>'files')) }}
				{{ Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Save', array('type' => 'submit', 'class' => 'btn btn-primary'))}}
				{{ HTML::decode(HTML::link('admin/'.$section.'/slider/'.$type.'/'.$id_theme.'/list', '<i class="glyphicon glyphicon-circle-arrow-left"></i> Back', array('class' => 'btn btn-success'))); }}
		{{ Form::close() }}

		<script>
		  $(document).ready(function() {

     		$('#save').click(function() {
				$('#sorting').submit();
			});

				$("#sortable").sortable();
				var files= new Array();
				$(".li_or").each(function(index) {
				files[index]=$(this).attr("rel");
				});
				$('#files').val(files);
		  });

		  function send()
		  {

		  	t=$("#files").val();
		  	console.log(t);

		     var files= new Array();
		     $('.li_or').each(function(index) {
		     files[index]=$(this).attr("rel");
		      });
		     $('#files').val(files);
		  }

		</script>

@stop

