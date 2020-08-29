@extends('layouts.app')
@section('content')
<div class="container flex">
     <div class="col w-50">
        <div class="row w-100">
            <div class="card">
                <div class="card-header" role="alert">GitHub</div>
                    <div class="card-body">
                        <form class="form-group" class="w-100 " action="{{ route('github.get') }}" method="post">
                            @csrf
                            @method('POST')
                            <label class="col-form-label" for="usergit">Usuario</label>
                            <input id="usergit" class="form-control w-100" type="text" name="user" require>
                            <label class="col-form-label" for="reposgit">Repositorio</label>
                            <input id="reposgit" class="form-control" type="text" name="repos" require>
                            <label class="col-form-label" class="col-form-label" for="descgit">descrição</label>
                            <textarea name="description"  class="form-control"  id="descgit" cols="30" rows="10" placeholder="descrição do repositorio" require></textarea>
                            <div class="modal-footer">
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">upload repositorio</button>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
        <div class="col w-50">
            <div class="row">
                <figure class="figure">
                    @if(!empty($success) && !empty($repos))
                        <img src="{{ $repos['repository'] }}" class="figure-img img-fluid rounded" alt="imagem do usuario github">
                        <figcaption class="figure-caption text-xs-right">
                            <strong>
                            {{ $repos['user'] }}
                            </strong>
                            <p>{{ $success }}</p>
                        </figcaption>
                    @elseif(!empty($success))
                        <div class="alert alert-warning" role="alert">
                            {{ $success }}
                        </div>
                    @else
                        <figure>
                            <img class="ml-2 cover" src="{{ asset('storage/icons/github.png') }}" alt="">
                            <figcaption>
                                <h4 class="h3 pl-4">Repositorio GitHub</h4>
                            </figcaption>
                        </figure>
                    @endif
                </figure>
            </div>
        </div>                      
    </div>
@endsection