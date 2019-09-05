@extends('layouts.app')

@section('content')

<h2 class="lef"> Criar projeto </h2>
<form method="post" action="/projects" enctype="multipart/form-data" class="lef">

	@csrf

	Titulo:<br>
	<input type="text" name="title">
	<br>
	Descrição:<br>
	<textarea name="description"></textarea>
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
    <input type="file" name="file">
    <br><br>

	<button type="submit">Enviar</button>

</form>

<br>

<button class="lef"><a href="/projects" >VER</a></button>


@endsection