<h1> Editar Itens </h1>


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

<br>

<a href="/projects/show/{{$project->id}} ">VER</a>
<br>
<a href="/projects">LISTAR</a>