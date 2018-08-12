@extends('admin.master')

@section('content')

			<div>

				@if ($errors->has())
				<?php $project_name = Input::old('project_name'); ?>
					@foreach($errors->all() as $error)
					<div>
						<button type="button">×</button>
						<span>Hata :</span> {{ $error }}
					</div>
					@endforeach
				@else
				<?php $project_name = !empty($project->project_name) ? $project->project_name : ''; ?>
				@endif

				<form method="POST" action="{{ $post_route }}">
					<fieldset>
						<div>
							<label for="project_name">Project Name <code>*</code> : </label>
							<div>
								<input type="text" id="project_name" name="project_name" value="{{ $project_name }}">
							</div>
						</div>

					</fieldset>

					@if(isset($project->id))
						<input type="hidden" id="id" name="id" value="{{ $project->id }}" />
					@endif

					<div>
						<input type="hidden" name="_token" value="{{ csrf_token() }}" />
						<button type="submit">Gönder</button>
						<a href="{{ URL::to('admin/projects') }}">İptal</a>
					</div>
				</form>
			</div>

@endsection

@section('page-specific-js')

@if (Session::get('note') != '')
	<script type="text/javascript">
		alert('{{ Session::get('note') }}');
		{{ Session::forget('note') }}
	</script>
@endif

@endsection
@stop
