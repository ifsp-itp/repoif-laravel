@extends('layouts.app')

@section('content')

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
        <img src="/storage/files/{{$project->project}}" class="img-resposive imgdefine">          
    @else
            @if($project->file_type == 0)

                    <iframe id="siteframe" class="codeExib mincodeweb w-100 h-50" src="{{$project->path_web}}/index.html"></iframe>
                    
            @endif
    @endif
    <div class="card-columns my-3 ml-3">
        <div class="card-group-sm">
            <div>
                <form action="/like/{{$project->id}}" method="POST" class="form-inline fl btnLD btnLike">
                    @method('POST')
                    @csrf
                    <br>
                    <button class="btn btn-outline-success btn-sm" name="idProjeto">
                        <i class="fa fa-thumbs-up"> {{$temLike}}</i>
                    </button>
                </form>
            </div>
        </div>
        <div class="card-group">
                <div>
                    @if($project->type != '2')
                        <a href="/download/{{$project->download}}" class="fl btnLD">
                            <button type="button" class="btn btn-outline-success btn-sm">
                                <i class="fa fa-cloud-download">Download</i>
                            </button>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="comentArea fl w-100 comentfixed">

        @forelse ($project->comments as $comment)
        <table class="table table-bordered table-orange" style="border-color: gray; opacity: 0.4;">
            <div class="container">
                <thead>
                    <tr>
                        <th scope="col" colspan="2">
                            <span>
                                @if($comment->user->image == null)
                                <img src="/storage/users/user.png" class="userThumb">
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
        <div id="description">
            <i class="fa fa-eye largura"> {{$project->views}} pessoas visualizaram isso</i>
            <i class="fa fa-heart largura"> {{$project->likes->count()}} pessoas gostaram disso</i>

        </div>
    </div>


    <div class="fl mgl dvShow">

        <form action="/coments/{{$project->id}}" method="POST" class="btnLD">
            @method('POST')
            @csrf
            <textarea name="body" id="form7" placeholder="Deixe seu comentário!" class="md-textarea form-control txtPerson"  value="Deixe seu comentário!" style="height:200px; font-size: 20pt;" required>
			</textarea>
            <button type="submit" class="btn btn-outline-success fr ml-2 my-5 mx-2"> Comentar </button>
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
