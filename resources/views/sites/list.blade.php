@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-11">
                <h2>Sites</h2>
            </div>
            <div class="col-lg-1">
                <a class="btn btn-success" href="{{ route('sites.create') }}">Adicionar</a>
            </div>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>URL</th>
                <th>Nº de Requisições</th>
                <th>Data Ultima Consulta</th>
                <th width="280px">Ação</th>
            </tr>
            @foreach ($sites as $site)
                <tr>
                    <td>{{ $site->id }}</td>
                    <td>{{ $site->url }}</td>
                    <td>{{ $site->total }}</td>
                    <td>{{ $site->last_request }}</td>
                    <td>
                        <form action="{{ route('sites.destroy',$site->id) }}" method="POST">
                            <a class="btn btn-primary" href="{{ route('sites_logs.index',['site_id' => $site->id]) }}">Visualizar Respostas</a>
                            <a class="btn btn-primary" href="{{ route('sites.edit',$site) }}">Editar</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
