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
	Tags:<br>
	<textarea name="tags" 
		placeholder="Separar todas as tags com vírgulas, EX: 'informatica, projetos, etc,' " style="width: 245px; height: 80px;">
		
	</textarea>
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

<a href="/projects" >VER</a>


@endsection