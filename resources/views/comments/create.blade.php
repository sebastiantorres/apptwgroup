@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8 offset-sm-2">
                <h1 class="display-3">Nuevo Comentario</h1>
                <div>
                    @if(Session::has('message-error'))
                        <div class="alert alert-danger alert-dismissible " role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span></button>
                            <h4>Algo no salio bien!</h4>
                            <p class="alert alert-danger">{{ Session::get('message-error') }}</p>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div><br />
                    @endif
                    <form method="post" action="{{ route('comments.store') }}">
                        @csrf
                        <input type="hidden" value="{{$publication_id}}" name="publication_id">
                        <div class="form-group">
                            <label for="content">Contenido:</label>
                            <textarea class="form-control" name="content"></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{route('publications.index')}}" class="btn btn-secondary">Cancelar</a>

                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary">Guardar</button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
