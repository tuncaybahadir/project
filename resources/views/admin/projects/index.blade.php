@extends('admin.master')

@section('content')
                    <table>
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Project Name</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($projects as $row)
                            <tr>
                                <td>{{ $row->id }}</td>
                                <td>
                                   {{ $row->project_name }}
                                </td>
                                <td>
                                    <a href="{{ URL::to('admin/projects/edit') . '/' . $row->id }}">Düzenle</a>
                                    <a href="{{ URL::to('admin/projects/delete') . '/' . $row->id }}">Sil</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

@endsection



@stop
