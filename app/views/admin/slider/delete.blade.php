{{ Form::open(array('url' => 'admin/news/slider/delete/')) }}  



	{{ HTML::decode(Form::label('', 'Are you sure that you want to delete this item? <p class="lead">'.$item->image.'</p>', array('class' => 'control-label'))) }}
	{{ Form::hidden('id', $item->id) }}
	{{ Form::hidden('id_item', $id_item) }}
	{{ Form::hidden('type', $type) }}

{{ Form::close() }}