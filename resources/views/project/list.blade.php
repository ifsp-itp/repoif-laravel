@extends('layouts.app')

@section('content')


	<div class="card-deck">
		@foreach ($projects as $project) 
		  <div class="card mb-3" style="min-width: 19.3rem;">
		    <img src="/storage/files/{{$project->project}}" class="card-img-top" alt="...">
		    <div class="card-body">
		      <h5 class="card-title">{{$project->title}}</h5>
		      <p class="card-text">{{$project->description}}</p>
		    </div>
		    <div class="card-footer">
		      <small class="text-muted">Desenvolvido por: <a href="/user/profile/{{$project->user_id}}">x</a></small>
		      @if($project->likes<=100)
		      <img src="/storage/files/bronze.png" width="30px" height="30px" style="float: right;">
		      @elseif($project->likes<=500)
		      <img src="/storage/files/silver.png" width="30px" height="30px" style="float: right;">
		      @else
		      <img src="/storage/files/gold.png" width="30px" height="30px" style="float: right;">
		      @endif
		    </div>
		  </div>
		@endforeach
	</div>

	<br>
	<a href="projects/create">CRIAR</a>

	
</div>
@endsection
