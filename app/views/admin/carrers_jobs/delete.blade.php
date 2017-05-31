{{ Form::open(array('url' => 'admin/carrers_jobs/delete/')) }}
	{{ HTML::decode(Form::label('', 'Are you sure that you want to delete this item? <p class="lead">'.$item->link.'</p>', array('class' => 'control-label'))) }}
	{{ Form::hidden('id', $item->id) }}
{{ Form::close() }}