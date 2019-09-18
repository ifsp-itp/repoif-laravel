@extends('layouts.app')

@section('content')

<div class="row"> 
	@if($project->type == '2')         
	
		<div class="embed-responsive embed-responsive-16by9">
      		<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{$project->project}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>         
      	</div>
    
	@else
      <img src="/storage/files/{{$project->project}}" class="img-responsive">
	@endif

</div>


<h1 class="lef">Mostrar um item</h1> 

<h1 class="lef"> ESSE É O PROJETO NÚMERO {{$project->id}}</h1>

<table border="1" class="lef">
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
	<td><strong>This is Creator:</strong></td>
	<td>{{$project->user->name}}</td>
</tr>
<tr>
	<td><strong>This is Date:</strong></td>
	<td>{{ date('d/m/Y', strtotime($project->date))}}</td>
</tr>
<tr>
	<td><strong>This is your file:</strong></td>


	
</tr>
<tr>
	<td><a href="/projects/edit/{{ $project->id }}">EDITAR</a></td>
	<td><a href="/projects/destroy/{{ $project->id }}">DELETAR</a></td>
</tr>

<tr>
	<td>
		<a href="/download/{{$project->download}}">
		<button style="padding: 3px; border-radius: 5px;">
			<strong style="float: left;">download</strong>
		</button>
	</a>
	</td>
	<td>
		<form method="post" action="/projects/like/{{ $project->id }}">
			@method('PUT')
	    	@csrf
				<button name="likes" style="padding: 3px; border-radius: 5px;" type="submit">Like</button> 
			{{$project->likes}} people liked this
		</form>
	</td>
</tr>
</table> 
<br>

<a href="/projects" class="lef">Voltar</a>
@endsection
