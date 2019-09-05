@extends('layouts.app')

@section('content')
	<h1 class="lef">LISTA DE PROJETOS CRIADOS!</h1>

	@foreach ($projects as $project) 

	<h1 class="lef"> ESSE É O PROJETO NÚMERO {{$project->id}}</h1>

	<table border="1" class="lef" style="margin-bottom: 40px;">
	<tr>
		<td><strong>This is Title:</strong></td>
		<td>{{ $project->title }}</td>
	</tr>
	<tr>
		<td><strong>This is Description:</strong></td>
		<td>{{ $project->description }}</td>
	</tr>
	<tr>
		<td><strong>This is ID:</strong></td>
		<td>{{ $project->id }}</td>
	</tr>
	<tr>
		<td><strong>This is Type:</strong></td>
		<td>{{ $project->type }}</td>
	</tr>
	<tr>
		<td><strong>This is Date:</strong></td>
		<td>{{ date('d/m/Y', strtotime($project->date))}}</td>
	</tr>
	<tr>
		<td><strong>This is Creator:</strong></td>
		<td>{{$project->user->name}}</td>
	</tr>
	<tr>
		<td><strong>This is your file:</strong></td>
		<td><img src="storage/files/{{$project->project}}" width="200px" height="200px"></td>
	</tr>
	<tr>
		<td><a href="/projects/show/{{ $project->id }}">VER</a></td>
		<td></td>
	</tr>

	</table>


	@endforeach
	<br><br>
	<button class="lef"><a href="projects/create">CRIAR</a></button>

@endsection
