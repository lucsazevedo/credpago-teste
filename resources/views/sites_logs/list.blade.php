@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-11">
                <h2>Logs</h2>
            </div>
        </div>

        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>URL</th>
                <th>Status</th>
                <th>Hora</th>
                <th>Data</th>
            </tr>
            @foreach ($logs as $log)
                <tr>
                    <td>{{ $log->id }}</td>
                    <td>{{ $log->sites->url }}</td>
                    <td>{{ $log->resposta }}</td>
                    <td>{{ $log->created_at }}</td>
                    <td>{{ $log->data }}</td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
