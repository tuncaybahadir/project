<!DOCTYPE html>
<html lang="tr-TR">
<head>
    <title>Yönetim Paneli</title>
    @yield('page-specific-css')

</head>
<body>
{{  Auth::user()->name }}

<ul>
    <li><a href="/admin">Yönetim Paneli</a></li>
    <li></li>
    <li><a href="{{ URL::to('admin/users') }}">Tüm Kullanıcılar</a></li>
    <li><a href="{{ URL::to('admin/users/create') }}">Kullanıcı Ekle</a></li>
    <li></li>
    <li><a href="{{ URL::to('admin/projects') }}">Tüm Projeler</a></li>
    <li><a href="{{ URL::to('admin/projects/create') }}">Proje Ekle</a></li>
    <li></li>
    <li><a href="{{ URL::to('admin/versions') }}">Tüm Versiyonlar</a></li>
    <li><a href="{{ URL::to('admin/versions/create') }}">Versiyon Ekle</a></li>
    <li></li>
    <li><a href="{{ URL::to('admin/values') }}">Tüm Veriler</a></li>
    <li><a href="{{ URL::to('admin/values/create') }}">Veri Ekle</a></li>
    <li></li>
    <li><a href="{{ URL::to('admin/password') }}">Şifremi Değiştir</a></li>
    <li></li>
    <li><a href="{{ URL::to('admin/logout') }}">Oturumu Kapat</a></li>
</ul>
<div class="content">
    @yield('content')
</div>

@if (Session::get('note') != '')
    <script type="text/javascript">
        alert('{{ Session::get('note') }}');
        {{ Session::forget('note') }}
    </script>
@endif

@yield('page-specific-libs')
@yield('page-specific-js')

</body>
</html>
