@extends('layouts.app')

@section('content')

<div id="background">
	<div class="card-deck">

		@foreach ($projects as $project) 
			<div class="card mb-3 cover total">
				@if($project->type == 1)
			  	<a href="/projects/show/{{$project->id}}" class="border-card-1 project-icon">
			  		<img src="/storage/files/{{$project->project}}" class="cover card-img-top" id="imgCardRI" alt="...">
			  	@elseif($project->type == 2)
			  	<a href="/projects/show/{{$project->id}}" class="border-card-2 project-icon">
			    	<img src="{{$project->thumbnailURL}}" class="cover card-img-top" id="imgCardRI" alt="...">
			    @elseif($project->type == 2)
			    <a href="/projects/show/{{$project->id}}" class="border-card-3 project-icon">
			    	<img src="{{$project->thumbnailURL}}" class="cover card-img-top" id="imgCardRI" alt="...">
			 	@endif
			    </a>
			    
			    <div class="card-body">
			      <h5 class="card-title fs">{{$project->title}}</h5>
			      <p class="card-text">
			      	<small class="text-muted fl">
				      	<a href="/projects/userProject/{{$project->user->id}}">
				      		<img src="/storage/files/profile.jpg" class="userThumb"> 
				      		<span class="nameControll">{{$project->user->name}}</span>
				      	</a>
			      	</small>

			      </p>
			    </div>
			    <div class="card-footer">

			      <span class="likesControll">
			      	<i class="fa fa-heart fontIcon"></i> {{$project->likes}}
			      </span>

			      <span class="likesControll">
			      	<i class="fa fa-comment fontIcon"></i> 0
			      </span>

			      <span class="likesControll">
			      	<i class="fa fa-eye fontIcon"></i> 0
			      </span>

			      @if ($project->type == 1)
			      <img src="/storage/files/photo.png" class="imgList">
			      @elseif ($project->type == 2)
			      <img src="/storage/files/video.png" class="imgList">
			      @elseif ($project->type == 3)
			      <img src="/storage/files/script.png" class="imgList">
			      @endif

			    </div>
			</div>
		@endforeach

	</div>
</div>
@endsection
