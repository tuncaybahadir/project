@extends('admin.master')

@section('content')
                    <table>
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Project ID</th>
                            <th>Project Name</th>
                            <th>Version</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($versions as $row)
                            <tr>
                                <td>{{ $row->id }}</td>
                                <td>{{ $row->project_id }}</td>
                                <td>
                                   {{ $row->project->project_name }}
                                </td>
                                <td>{{ $row->version }}</td>
                                <td>
                                    <a href="{{ URL::to('admin/versions/edit') . '/' . $row->id }}">Düzenle</a>
                                    <a href="{{ URL::to('admin/versions/delete') . '/' . $row->id }}">Sil</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

@endsection



@stop
