@extends('admin.master')

@section('content')
                    <table>
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Mail Adresi</th>
                            <th>Adı</th>
                            <th>Yetki</th>
                            <th>Durum</th>
                            <th>İşlem</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $row)
                            <tr>
                                <td>{{ $row->id }}</td>
                                <td>
                                    <a href="{{ URL::to('admin/users/edit') . '/' . $row->id }}">{{ $row->email }}</a>
                                </td>
                                <td>{{ $row->name }}</td>
                                <td>
                                    @if ($row->role == 1)
                                        Admin
                                    @else
                                        Editor
                                    @endif
                                </td>
                                <td>
                                    @if ($row->active == 1)
                                        Aktif
                                    @else
                                        Pasif
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ URL::to('admin/users/edit') . '/' . $row->id }}">Düzenle</a>
                                    <a href="{{ URL::to('admin/users/delete') . '/' . $row->id }}">Sil</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

@endsection



@stop
