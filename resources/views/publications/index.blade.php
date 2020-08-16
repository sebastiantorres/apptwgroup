@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center m-2">
            <div class="col-md-8">
                <h5>Publicaciones</h5>
            </div>
            <div class="col-md-2">
                <a href="{{route('publications.create')}}" class="btn btn-secondary">Nueva publicación </a>
            </div>
        </div>

        @if(! $publications)
            <div class="row ">
                <div class="col-md-10 alert-info mx-auto">
                    <h6 class="text-center"> No se encontraron publicaciones</h6>
                </div>
            </div>

        @endif
        @foreach($publications as $publication)
            <div class="row justify-content-center mt-4">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-8">
                                    {{ $publication->title}}
                                </div>
                                <div class="col-md-4">
                                    <small> {{date('d/m/Y H:i:s', strtotime($publication->created_at))}}
                                    </small>
                                </div>
                            </div>


                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <p>{{$publication->content}}</p>
                                </div>
                            </div>
                            <div class="row m-2">
                                <div class="col-md-8">
                                    <h6> Comentarios</h6>
                                </div>
                                <div class="col-md-4">
                                    <a href="{{route('comments.create',['id'=>$publication->id])}}" class="btn btn-sm btn-secondary">Agregar
                                        Comentario </a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    @if( count($publication->comments)>0)
                                        @foreach( $publication->comments as $comment)
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <span> Creado por : {{$comment->user->name}}</span>
                                                                </div>
                                                                <div class="col-md-6 text-right">
                                                                    {{date('d/m/Y H:i:s', strtotime($comment->created_at))}}
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="card-body">
                                                            {{$comment->content}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="row">
                                            <div class="col-md-10 alert-info mx-auto">
                                                <h6 class="text-center"> No se encontraron comentarios</h6>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
