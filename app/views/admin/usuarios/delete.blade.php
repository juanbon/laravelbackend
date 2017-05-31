{{ Form::open(array('url' => 'admin/news/delete/')) }}
	{{ HTML::decode(Form::label('', 'Are you sure that you want to delete this item? <p class="lead">'.$item->title.'</p>', array('class' => 'control-label'))) }}
	{{ Form::hidden('id', $item->id) }}
{{ Form::close() }}