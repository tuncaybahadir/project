@extends('admin.master')

@section('content')

			<div>

				@if ($errors->has())
				<?php $project_id = Input::old('project_id'); ?>
				<?php $version_id = Input::old('version_id'); ?>
 				<?php $lang = Input::old('lang'); ?>
				<?php $key = Input::old('key'); ?>
				<?php $value = Input::old('value'); ?>
					@foreach($errors->all() as $error)
					<div>
						<button type="button">×</button>
						<span>Hata :</span> {{ $error }}
					</div>
					@endforeach
				@else
				<?php $project_id = !empty($values->project_id) ? $values->project_id : ''; ?>
				<?php $lang = !empty($values->lang) ? $values->lang : ''; ?>
				<?php $version_id = !empty($values->version_id) ? $values->version_id : ''; ?>
				<?php $key = !empty($values->key) ? $values->key : ''; ?>
				<?php $value = !empty($values->value) ? $values->value : ''; ?>
				@endif

				<form method="POST" action="{{ $post_route }}">
					<fieldset>
						<div>
							<label for="project_id">Proje<code>*</code> : </label>
							<div>
								<select name="project_id" id="project_id">
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
								<select name="version_id" id="version_id" disabled>
									@if(empty($version_id))
										<option value="">Proje Seçiniz...</option>
									@endif
									@if(isset($versions))
										@foreach($versions as $index=>$row)
											<option value="{{ $row->id }}" @if($version_id == $row->id) selected="selected"@endif>{{ $row->version }}</option>
										@endforeach
									@endif
								</select>
							</div>
						</div>

						<div>
							<label for="lang">Lang <code>*</code> : </label>
							<div>
								<select name="lang">
									@if(empty($lang))
										<option value="">Dil Seçiniz...</option>
									@endif
									@foreach($langs as $index=>$row)
										<option value="{{ $index }}" @if($lang == $index) selected="selected"@endif>{{ $row }}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div>
							<label for="key">Key <code>*</code> : </label>
							<div>
								<input type="text" id="key" name="key" value="{{ $key }}">
							</div>
						</div>

						<div>
							<label for="value">Value <code>*</code> : </label>
							<div>
								<input type="text" id="value" name="value" value="{{ $value }}">
							</div>
						</div>

					</fieldset>

					@if(isset($values->id))
						<input type="hidden" id="id" name="id" value="{{ $values->id }}" />
					@endif

						<div>
							<input type="hidden" name="_token" value="{{ csrf_token() }}" />
							<button type="submit">Gönder</button>
							<a href="{{ URL::to('admin/values') }}">İptal</a>
						</div>
				</form>
			</div>

@endsection

@section('page-specific-js')

<script src="{{ '/js/jquery.js' }}"></script>

<script>
    $(document).ready(function(){
        $('#project_id').on('change', function (e) {
            var selected = $(this).find("option:selected").val();
            if (selected>0)
            {
                $.ajax({
                    url: '/admin/versions/check',
                    type: 'POST',
                    data: {
                        project_id : selected
                    },
                    error: function(){
                        alert("Bir Hata Oluştu !");
                    },
                    success: function (response) {
                        $('#version_id').removeAttr('disabled');
                        if (response) {
                            $("#version_id option").remove();
                            $(response).each(function (index, item) {
                                $("#version_id").append('<option value="'+item.id+'">'+item.version+'</option>');
                            });
                        }
                    }
                });
            }
        });


    });
</script>


	@if (Session::get('note') != '')
	<script type="text/javascript">
		alert('{{ Session::get('note') }}');
		{{ Session::forget('note') }}
	</script>
@endif

@endsection
@stop
