@extends('layouts.app') @section('content')
<div class="container flex">
    <div class="col w-50">
        <div class="row w-100">
            <div class="card">
                <div class="card-header" role="alert">GitHub</div>
                <div class="card-body">
                    <form class="form-group" class="w-100 " action="{{ route('github.get') }}" method="post">
                        @csrf @method('POST')
                        <label class="col-form-label" for="usergit">Usuario</label>
                        <input id="usergit" class="form-control w-100" type="text" name="user" require>
                        <label class="col-form-label" for="reposgit">Repositorio</label>
                        <input id="reposgit" class="form-control" type="text" name="repos" require>
                        <label class="col-form-label" class="col-form-label" for="descgit">descrição</label>
                        <textarea name="description" class="form-control" id="descgit" cols="30" rows="10" placeholder="descrição do repositorio" require></textarea>
                        <div class="modal-footer">
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">upload repositorio</button>
                            </div>
                        </div>
                        <div id="mobile">
                            @if(!empty($success) && !empty($repos))
                            <div class="alert alert-primary" role="alert">
                                Seu site foi trazido para o RepoIF!!!
                            </div>
                            @elseif(!empty($success))
                            <div class="alert alert-warning" role="alert">
                                {{ $success }}
                            </div>
                            @else

                            <div class="alert alert-success bg-dark text-light">
                                Bem vindo ao serviço de dowload do GitHub <i class="fa fa-code" aria-hidden="true"></i>
                            </div>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col w-50" id="desktop">
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
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 480 512"><!-- Font Awesome Free 5.15.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) --><path d="M186.1 328.7c0 20.9-10.9 55.1-36.7 55.1s-36.7-34.2-36.7-55.1 10.9-55.1 36.7-55.1 36.7 34.2 36.7 55.1zM480 278.2c0 31.9-3.2 65.7-17.5 95-37.9 76.6-142.1 74.8-216.7 74.8-75.8 0-186.2 2.7-225.6-74.8-14.6-29-20.2-63.1-20.2-95 0-41.9 13.9-81.5 41.5-113.6-5.2-15.8-7.7-32.4-7.7-48.8 0-21.5 4.9-32.3 14.6-51.8 45.3 0 74.3 9 108.8 36 29-6.9 58.8-10 88.7-10 27 0 54.2 2.9 80.4 9.2 34-26.7 63-35.2 107.8-35.2 9.8 19.5 14.6 30.3 14.6 51.8 0 16.4-2.6 32.7-7.7 48.2 27.5 32.4 39 72.3 39 114.2zm-64.3 50.5c0-43.9-26.7-82.6-73.5-82.6-18.9 0-37 3.4-56 6-14.9 2.3-29.8 3.2-45.1 3.2-15.2 0-30.1-.9-45.1-3.2-18.7-2.6-37-6-56-6-46.8 0-73.5 38.7-73.5 82.6 0 87.8 80.4 101.3 150.4 101.3h48.2c70.3 0 150.6-13.4 150.6-101.3zm-82.6-55.1c-25.8 0-36.7 34.2-36.7 55.1s10.9 55.1 36.7 55.1 36.7-34.2 36.7-55.1-10.9-55.1-36.7-55.1z"/></svg>
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