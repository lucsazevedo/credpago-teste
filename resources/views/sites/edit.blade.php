@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-11">
                <h2>Editar Site</h2>
            </div>
            <div class="col-lg-1">
                <a class="btn btn-primary" href="{{ url('sites') }}"> Voltar</a>
            </div>
        </div>
        <form action="{{ route('sites.update',$sites->id) }}" method="POST">
            @method('PATCH')
            @csrf
            <div class="form-group row">
                <label for="url" class="col-sm-2 col-form-label">URL</label>
                <div class="col-sm-10">
                    <input id="url" type="url" class="form-control @error('url') is-invalid @enderror" name="url"
                           value="{{ $sites->url }}" required autocomplete="url">

                    @error('url')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
