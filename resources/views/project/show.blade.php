@extends('layouts.app') @section('content')

<div class="row">
    @if($project->type == '2' && $project->sent == '1')
        <div class="embed-responsive embed-responsive-16by9 fl imgdefine">
            <iframe id="daily" frameborder="0" width="640" height="360" src="https://www.dailymotion.com/embed/video/{{ $project->project }}?autoplay=1&ui-highlight=fff" allowfullscreen allow="autoplay;fullscreen"></iframe>
        </div>
    @elseif($project->type == '2' && $project->sent == '0')
        <div class="w-100 posvideo">
            <video class="w-100 videonorm" src="/storage/files/{{$project->project}}" controls="controls">
            video não suportado
            </video>
        </div>
    @elseif($project->type == '1')
        <img src="/storage/files/{{$project->project}}" class="figure-img cover card-img-top img-fluid cover-img w-100">
    @else @if($project->file_type == 0)
        <iframe id="siteframe" class="codeExib mincodeweb w-100 h-50" src="{{$project->path_web}}/index.html"></iframe>
    @endif @endif
</div>
<!--informações dos projetos-->
<div class="fl mgl dvShow dvDados">
    <div id="description">
        <i class="fa fa-eye largura">
            {{$project->views}} pessoas visualizaram isso
        </i>
        <i class="fa fa-heart largura">
            {{$project->likes->count()}} pessoas gostaram disso
        </i>
    </div>
</div>
<!---->
<div class="row my-2">
    <div class="col w-100 line-100">
        <section>
            <form action="/like/{{$project->id}}" method="POST" class="form-inline fl btnLD btnLike">
                @method('POST') @csrf
                <button class="btn btn-outline-success btn-sm likefmt" name="idProjeto">
                        <i class="fa fa-thumbs-up">{{$temLike}}</i>
                    </button>
            </form>
        </section>
        <section>
            @if($project->type != '2')
            <a href="/download/{{$project->download}}" class="fl btnLD">

                <button type="button" class="btn btn-outline-success btn-sm">
                        <i class="fa fa-download" aria-hidden="true">Download</i>
                </button>
            </a>
            @endif
        </section>
    </div>
</div>

<div id="comments" class="px-2 comments overflow-hidden">
    <div class="row w-100 scroll">

        <div class="centerlayot">
            <p style="padding: 2px; text-align: center;" id="pular">
                <div>Comentários</div>
                <i class="fa fa-comment" aria-hidden="true"><button id="commentsScroll">Clique aqui e comente<span class="writer"></span></button></i>
            </p>
        </div>
    </div>

    <!--comentarios-->
    @forelse ($project->comments as $comment)
    <div class="container-fluid py-2 px-2 color-comment">
        <div class="row mt-2 pt-1">
            <div class="col-sm-8">
                <div class="row">
                    <div class="col">
                        <!--usuario que comentou-->
                        <figure class="figure">
                            @if($comment->user->image == null)
                            <img src="/storage/users/user.png" class="figure-img img-fluid circle"> @else
                            <img src="/storage/{{ $comment->user->image }}" class="figure-img img-fluid circle"> @endif
                            <figcaption class="figure-caption">
                                {{ $comment->user->name }}
                            </figcaption>
                        </figure>
                    </div>
                    <div class="col date">
                        <!--data comentário-->
                        <p>{{ date('d/m/Y', strtotime($comment->date))}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <p class="area-coment">
                    {{ $comment->body }}
                </p>
            </div>
        </div>
        <div class="row">
            @if($comment->user_id == auth()->id())
            <a onclick="return myFunction();" href="/comment/destroy/{{ $comment->id }}">
                <button class="btn btn-danger ml-2 btn-sm fr delComent" type="submit">
                        Deletar Comentário
                    </button>
            </a>
            @endif
        </div>
    </div>
    <!--fim comentários-->
    @empty
    <table class="table table-bordered table-dark comments">
        <thead>
            <tr>
                <th scope="col" colspan="2">
                    Ainda não houve nenhum comentário! Seja o primeiro.
                </th>
            </tr>
        </thead>
    </table>
    @endforelse
</div>
</div>

</div>
<div class="container-fluid">
    <div class="fl mgl firstDiv">
        <section>
            <h4 class="h2">
                {{ $project->title }}
            </h4>
        </section>
        <section>
            <p class="h3"> Dados: </p>
            <p>
                <i class="fa fa-info" id="information" aria-hidden="true">
                    clique para obter maiores informações
                </i>
            </p>
            <article>
                <!--dados do projeto-->
                <div class="btn-close">
                    <div class="cont-info">
                        <div id="description">
                            {{ $project->description }}
                        </div>
                        <span class="creator"> 
                            Criado por:
                            <a href="/projects/userProject/{{$project->user->id}}">
                                {{$project->user->name}}
                            </a>
                        </span>
                        <p>
                            <span class="creator">
                                Data: {{ date('d/m/Y', strtotime($project->date))}}
                            </span>
                        </p>
                    </div>
                </div>
            </article>
        </section>

        @if($project->user->id == auth()->id() || auth()->id() == '1')
        <a href="/projects/edit/{{ $project->id }}">
            <button class="btn btn-outline-success btn-sm dvButtons" type="submit">
                        <strong class="fl">EDITAR</strong>
                </button>
        </a>
        <a onclick="return myFunction();" href="/projects/destroy/{{ $project->id }}">
            <button class="btn btn-danger btn-sm" type="submit">
                        DELETAR
                </button>
        </a>
        @endif

    </div>

    <div class="fl mgl dvShow">

        <form action="/coments/{{$project->id}}" method="POST" class="btnLD">
            @method('POST') @csrf
            <textarea name="body" id="form7" placeholder="Deixe seu comentário!" class="md-textarea form-control txtPerson" style="height:200px; font-size: 20pt;" required></textarea>
            <button type="submit" class="btn btn-outline-success fr ml-2 my-5 mx-2"> 
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                </svg>
                Comentar
            </button>
        </form>
    </div>
    <script>
        $(function(){
            $($('#commentsScroll')).click(function() {
                $(document.documentElement, document.body).animate({
                    scrollTop: $($('#form7')).offset().top - 70
                }, 2500)
                $('#form7').focus()
            })
        })

        function myFunction() {
            if (!confirm("DESEJA MESMO DELETAR ISSO?")) {
                event.preventDefault();
            }
        }

        function menu() {
            if (window.document.getElementsByClassName("menu")[0].style.display == "flex") {
                $(".menu").hide(32)
                var menu = window.document.getElementsByClassName("menu")[0].style.display = "none"
            } else if (window.document.getElementsByClassName("menu")[0].style.display == "none") {
                $(".menu").show(32)
                var menu = window.document.getElementsByClassName("menu")[0].style.display = "flex"
            } else {
                $(".menu").show(32)
                window.document.getElementsByClassName("menu")[0].style.display = "flex"
            }

        }
    </script>

</div>
@endsection