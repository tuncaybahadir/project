<!DOCTYPE html>
<html>
<head>
    <title>Yönetim Paneli</title>
</head>
<body>

                        <form method="post" action="<?php echo URL::to('admin/login') ?>">

                                <input type="text" id="email" name="email" placeholder="E-Posta Adresi">
                                <input id="password" name="password" type="password" placeholder="Parola">
                                <button type="submit">Giriş Yap</button>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        </form>

@if (Session::get('note') != '')
<script type="text/javascript">
    alert('{{ Session::get('note') }}');
    {{ Session::forget('note') }}
</script>
@endif

</body>
</html>
