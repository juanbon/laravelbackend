{{ Form::open(array('url' => 'admin/contact/delete/')) }}
	{{ HTML::decode(Form::label('', 'Are you sure that you want to delete this item? <p class="lead">'.$item->first_name.' '.$item->last_name.'</p>', array('class' => 'control-label'))) }}
	{{ Form::hidden('id', $item->id) }}
{{ Form::close() }}