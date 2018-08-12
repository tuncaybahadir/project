@extends('admin.master')

@section('content')

			<div>

				@if ($errors->has())
				<?php $name = Input::old('name'); ?>
				<?php $email = Input::old('email'); ?>
				<?php $password = Input::old('password'); ?>
				<?php $password_confirmation = Input::old('password_confirmation'); ?>
				<?php $role = Input::old('role'); ?>
				<?php $active =  Input::old('active'); ?>
					@foreach($errors->all() as $error)
					<div>
						<button type="button">×</button>
						<span>Hata :</span> {{ $error }}
					</div>
					@endforeach
				@else
				<?php $name = !empty($user->name) ? $user->name : ''; ?>
				<?php $email = !empty($user->email) ? $user->email : ''; ?>
				<?php $password = ''; ?>
				<?php $password_confirmation = ''; ?>
				<?php $role = isset($user->role) ? $user->role : ''; ?>
				<?php $active = isset($user->active) ? $user->active : 1; ?>
				@endif

				<form method="POST" action="{{ $post_route }}" enctype="multipart/form-data">
					<fieldset>
						<div>
							<label for="name">Adı <code>*</code> : </label>
							<div>
								<input type="text" id="name" name="name" value="{{ $name }}">
							</div>
						</div>

						<div>
							<label for="email">Mail Adresi <code>*</code> : </label>
							<div>
								<input type="email" id="email" name="email" value="{{ $email }}">
							</div>
						</div>

						<div>
							<label for="password">Şifre <code>*</code> : </label>
							<div>
								<input type="password" id="password" name="password" value="{{ $password }}">
							</div>
						</div>

						<div>
							<label for="password_confirmation">Tekrar Şifre <code>*</code> : </label>
							<div>
								<input type="password" id="password_confirmation" name="password_confirmation" value="{{ $password_confirmation }}">
							</div>
						</div>

						<div>
							<label for="role">Yetki <code>*</code> : </label>
							<div>
								<select name="role">
									<option value="">Yetki Seçiniz...</option>
									@foreach($userRoles as $key=>$row)
										<option value="{{ $key }}" @if($role == $key) selected="selected"@endif>{{ $row }}</option>
									@endforeach
								</select>
							</div>
						</div>



						<div>
							<label for="checkbox-ios1">Durum : </label>
							<div>
								<select id="active" name="active">
									<option value="">Seçiniz...</option>
									@foreach($activeRoles as $key=>$row)
										<option value="{{ $key }}" @if($active == $key) selected="selected"@endif>{{ $row }}</option>
									@endforeach
								</select>
							</div>
						</div>
					</fieldset>

					@if(isset($user->id))
						<input type="hidden" id="id" name="id" value="{{ $user->id }}" />
					@endif

					<div class="form-actions">
						<div class="row">
							<div class="col-sm-offset-4 col-sm-7">
								<input type="hidden" name="_token" value="{{ csrf_token() }}" />
								<button type="submit" class="btn btn-primary">Gönder</button>
								<a class="btn btn-inverse" href="{{ URL::to('admin/users') }}">İptal</a>
							</div>
						</div>
					</div>
				</form>
			</div>

		</section>

	</main>

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
