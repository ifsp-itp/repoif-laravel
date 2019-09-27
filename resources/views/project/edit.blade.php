<h1> Editar Itens </h1>

@if ($project->user_id == auth()->id() || auth()->id() == '1')
<form method="post" action="/projects/show/{{ $project->id }}" enctype="multipart/form-data">

    @method('PUT')
    @csrf

    Titulo:<br>
    <input type="text" name="title" value="{{ $project->title }}">
    <br>
    Descrição:<br>
    <textarea name="description">{{ $project->description }}</textarea>
    <br>
    Tipo do projeto:<br>
    <select name="type">
          <option value="1">Foto</option>
          <option value="2">Vídeo</option>
          <option value="3">PDF</option>
          <option value="4">Código</option>
    </select>
    <br>
    Projeto:<br>
    <img src="/storage/files/{{$project->project}}" width="200px" height="200px">
    <br>

    <button type="submit">Atualizar</button>

</form>

@else

 <link href='https://fonts.googleapis.com/css?family=Anton|Passion+One|PT+Sans+Caption' rel='stylesheet' type='text/css'>
<body>

        <!-- Error Page -->
            <div class="error">
                <div class="container-floud">
                    <div class="col-xs-12 ground-color text-center">
                        <div class="container-error-404">
                            <div class="clip"><div class="shadow"><span class="digit thirdDigit"></span></div></div>
                            <div class="clip"><div class="shadow"><span class="digit secondDigit"></span></div></div>
                            <div class="clip"><div class="shadow"><span class="digit firstDigit"></span></div></div>
                            <div class="msg">OH!<span class="triangle"></span></div>
                        </div>
                        <h2 class="h1">Sorry! Page not found</h2>
                    </div>
                </div>
            </div>
        <!-- Error Page -->
</body>

@endif
<br>

<a href="/projects/show/{{$project->id}} ">VER</a>
<br>
<a href="/projects">LISTAR</a>