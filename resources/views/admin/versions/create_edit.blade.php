@extends('admin.master')

@section('content')

			<div>

				@if ($errors->has())
				<?php $project_id = Input::old('project_id'); ?>
				<?php $version = Input::old('version'); ?>
					@foreach($errors->all() as $error)
					<div>
						<button type="button">×</button>
						<span>Hata :</span> {{ $error }}
					</div>
					@endforeach
				@else
				<?php $project_id = !empty($values->project_id) ? $values->project_id : ''; ?>
				<?php $version = !empty($values->version) ? $values->version : ''; ?>
				@endif

				<form method="POST" action="{{ $post_route }}">
					<fieldset>
						<div>
							<label for="project_id">Proje<code>*</code> : </label>
							<div>
								<select name="project_id">
									@if(empty($project_id))
										<option value="">Proje Seçiniz...</option>
									@endif
									@foreach($projects as $index=>$row)
										<option value="{{ $row->id }}" @if($project_id == $row->id) selected="selected"@endif>{{ $row->project_name }}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div>
							<label for="version">Version <code>*</code> : </label>
							<div>
								<input type="text" id="version" name="version" value="{{ $version }}">
							</div>
						</div>

					</fieldset>

					@if(isset($values->id))
						<input type="hidden" id="id" name="id" value="{{ $values->id }}" />
					@endif

						<div>
							<input type="hidden" name="_token" value="{{ csrf_token() }}" />
							<button type="submit">Gönder</button>
							<a href="{{ URL::to('admin/versions') }}">İptal</a>
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
