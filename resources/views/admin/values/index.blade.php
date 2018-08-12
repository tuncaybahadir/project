@extends('admin.master')

@section('content')
                    <table>
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Project ID</th>
                            <th>Project Name</th>
                            <th>Version</th>
                            <th>Lang</th>
                            <th>Key</th>
                            <th>Value</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($values as $row)
                            <tr>
                                <td>{{ $row->id }}</td>
                                <td>{{ $row->project_id }}</td>
                                <td>
                                   {{ $row->project->project_name }}
                                </td>
                                <td>{{ $row->version->version }}</td>
                                <td>{{ $value_langs[$row->lang] }}</td>
                                <td>{{ $row->key }}</td>
                                <td>{{ $row->value }}</td>
                                <td>
                                    <a href="{{ URL::to('admin/values/edit') . '/' . $row->id }}">Düzenle</a>
                                    <a href="{{ URL::to('admin/values/delete') . '/' . $row->id }}">Sil</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

@endsection



@stop
