@extends('admin.master')

@section('content')

        <section class="widget">
            <div class="widget-body">
                @if ($errors->has())
                    <?php $old = Input::old('old_password'); ?>
                    <?php $new = Input::old('new_password'); ?>
                    <?php $repeat = Input::old('new_password_confirmation'); ?>
                    @foreach($errors->all() as $error)
                        <div>
                            <button type="button">×</button>
                            <span>Hata :</span> {{ $error }}
                        </div>
                    @endforeach
                @endif
                <form role="form" method="post" action="{{ URL::to('admin/password/update') }}">
                    <fieldset>
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label for="type-dropdown-appended">Eski Şifre</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                        <input class="form-control" id="password-field" name="old_password" type="password">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="type-dropdown-appended">Yeni Şifre</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                        <input class="form-control" id="password-field" name="new_password" type="password">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="type-dropdown-appended">Yeni Şifre Tekrar</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                        <input class="form-control" id="password-field" name="new_password_confirmation" type="password">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </fieldset>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-inverse">Şifremi Değiştir</button>
                    </div>
                    <input type="hidden" id="_token" name="_token" value="<?php echo csrf_token(); ?>"/>
                </form>
            </div>
        </section>
    </main>
@endsection

@stop
