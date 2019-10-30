@extends('layouts.app')

@section('content')

<div id="background">
	<div class="card-deck">

		@foreach ($projects as $project) 
			<div class="card mb-3 cover total">
				@if($project->type == 1)
			  	<a href="/projects/show/{{$project->id}}" class="border-card-1 project-icon">
			  		<img src="/storage/files/{{$project->project}}" class="cover card-img-top" id="imgCardRI" alt="...">
			  	@elseif($project->type == 2 && $project->sent == '0')
			  	<a href="/projects/show/{{$project->id}}" class="border-card-2 project-icon">
			    	<img src="/storage/icons/videoThumb.png" class="cover card-img-top" id="imgCardRI" alt="...">
			  	@elseif($project->type == 2 && $project->sent == '1')
			  	<a href="/projects/show/{{$project->id}}" class="border-card-2 project-icon">
			    	<img src="{{$project->thumbnailURL}}" class="cover card-img-top" id="imgCardRI" alt="...">
			    
			    @elseif($project->type == 3)
			    <a href="/projects/show/{{$project->id}}" class="border-card-3 project-icon">
			    	<img src="/storage/icons/script.jpg" class="cover card-img-top" id="imgCardRI" alt="...">
			 	@endif
			    </a>
			    
			    <div class="card-body">

			      <div class="profileThumbHome fl">
			      	<a href="/projects/userProject/{{$project->user->id}}">
				      	@if($project->user->image == null)
				  		<img src="/storage/users/profile.jpg" class="userThumb">
				  		@else
				  		<img src="/storage/users/{{$project->user->image}}" class="userThumb">
				  		@endif
				  	</a>
			      </div>

			      <div class="fl">
			      	<span class="projectNameControll">
			      		{{$project->title}}
			      	</span>

			      	<br />

			      	<a href="/projects/userProject/{{$project->user->id}}">
				      	<span class="nameControll">
				      		{{$project->user->name}}
				      	</span>
				    </a>
			      </div>

			    </div>
			    <div class="card-footer">

			      <span class="likesControll">
			      	<i class="fa fa-heart fontIcon"></i> {{$project->likes->count()}}
			      </span>

			      <span class="likesControll">
			      	<i class="fa fa-comment fontIcon"></i> {{$project->comments->count()}}
			      </span>

			      <span class="likesControll">
			      	<i class="fa fa-eye fontIcon"></i> {{$project->views}}
			      </span>

			      @if ($project->type == 1)
			      <i class="far fa-images fr fontList1"></i>
			      @elseif ($project->type == 2)
			      <i class="fab fa-youtube fr fontList2"></i>
			      @elseif ($project->type == 3)
			      <i class="fas fa-code fr fontList3"></i>
			      @endif

			    </div>
			</div>
		@endforeach

	</div>
</div>
@endsection