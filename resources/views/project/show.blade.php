@extends('layouts.app')

@section('content')

<div class="row">
    @if($project->type == '2' && $project->sent == '1')
        <div class="embed-responsive embed-responsive-16by9 fl imgdefine">
            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{$project->project}}" frameborder="0"
                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>

    @elseif($project->type == '2' && $project->sent == '0')
        <div class="w-100 posvideo">
            <video class="w-100 videonorm" src="/storage/files/{{$project->project}}"
                controls="controls"></video>
        </div>

    @elseif($project->type == '1')
        <img src="/storage/files/{{$project->project}}" class="img-resposive w-100 imgdefine">

  
                
    @else
            @if($project->zip_default == 1)
                    Documento normal
            @elseif($project->file_type == 0)
                    <iframe class="codeExib mincodeweb w-100 h-50" src="{{$project->path_web}}/index.html"></iframe>
            @else
                    <iframe class="codeExib minCode w-100 h-50" src="/storage/files/{{ $project->download }}"></iframe>
                
            @endif
    @endif

    <div class="comentArea fl w-100 comentfixed">

        @forelse ($project->comments as $comment)
        <table class="table table-bordered table-dark">
            <div class="container">
                <thead>
                    <tr>
                        <th scope="col" colspan="2">
                            <span>
                                @if($comment->user->image == null)
                                <img src="/storage/icons/user.png" class="userThumb">
                                @else
                                <img src="/storage/{{$project->user->image}}" class="userThumb">
                                @endif
                            </span>
                            <span class="userComentLink">
                                {{ $comment->user->name }}
                            </span>

                            <span class="comentDate">
                                {{ date('d/m/Y', strtotime($comment->date))}}
                            </span>
                        </th>
                    </tr>

                    </code>


                    +
                </thead>
                <tbody>
                    <tr>
                        <td colspan="2" style="padding-bottom: 70px;">
                            <span class="comentArea">
                                {{ $comment->body }}
                            </span>
                        </td>
                    </tr>
                    <tr>

                        <td colspan="2" style="padding-bottom: 45px;">
                            @if($comment->user_id == auth()->id())
                            <a onclick="return myFunction();" href="/comment/destroy/{{ $comment->id }}">
                                <button class="btn btn-danger btn-sm fr delComent" type="submit">
                                    Deletar Comentário
                                </button>
                            </a>
                            @endif
                        </td>

                    </tr>
                </tbody>
            </div>
        </table>

        @empty
        <table class="table table-bordered table-dark">
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

<div>

    <div class="fl mgl firstDiv">

        <h4>{{ $project->title }}</h4>

        <div id="description">
            {{ $project->description }}
        </div>

        <span class="creator"> Criado por:
            <a href="/projects/userProject/{{$project->user->id}}">
                {{$project->user->name}}
            </a>
        </span>

        <p>
            <span class="creator">
                Data: {{ date('d/m/Y', strtotime($project->date))}}
            </span>
        </p>

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

    <div class="fl mgl dvShow dvDados">
        <h4> Dados </h4>
        <div id="date">ola</div>

        <div id="description">
            <i class="fa fa-eye largura"> {{$project->views}} pessoas visualizaram isso</i>
            <i class="fa fa-heart largura"> {{$project->likes->count()}} pessoas gostaram disso</i>

            <form action="/like/{{$project->id}}" method="POST" class="form-inline fl btnLD btnLike">
                @method('POST')
                @csrf
                <br>
                <button class="btn btn-outline-success btn-sm fl " name="idProjeto">
                    <i class="fa fa-thumbs-up"> {{$temLike}}</i>
                </button>
            </form>

            @if($project->type != '2')
            <a href="/download/{{$project->download}}" class="fl btnLD " style="margin-right: 13%;">
                <button type="button" class="btn btn-outline-success btn-sm ">
                    <i class="fa fa-cloud-download"> Download</i>
                </button>
            </a>
            @endif

        </div>
    </div>


    <div class="fl mgl dvShow">

        <form action="/coments/{{$project->id}}" method="POST">
            @method('POST')
            @csrf
            <textarea name="body" id="form7" class="md-textarea form-control txtPerson"
                style="height:200px; font-size: 20pt;">Deixe seu comentário!
			</textarea>
            <button type="submit" class="btn btn-outline-success fr"> Comentar </button>
        </form>
    </div>

    <div class="clb"></div>

</div>




<script>

function myFunction() {
    if (!confirm("DESEJA MESMO DELETAR ISSO?"))
        event.preventDefault();
}
    

</script>
@endsection
