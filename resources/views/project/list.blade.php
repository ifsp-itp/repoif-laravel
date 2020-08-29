@extends('layouts.app')

@section('content')

<div id="background">
	<div class="card flex card-deck">

		@foreach ($projects as $project) 
			<div class="block-size card mb-3 cover card-mutator">
				@if($project->type == 1)
			  	<a href="/projects/show/{{$project->id}}" class="border-card-1 project-icon">
			  		<img src="/storage/files/{{$project->project}}" class="cover card-img-top" id="imgCardRI" alt="foto de apresentação dos sites">
			  	@elseif($project->type == 2 && $project->sent == '0')
			  	<a href="/projects/show/{{$project->id}}" class="border-card-2 project-icon">
			    	<img src="/storage/icons/videoThumb.png" class="cover card-img-top" id="imgCardRI" alt="caminho do arquivo de apresentação dos videos">
			  	@elseif($project->type == 2 && $project->sent == '1')
			  	<a href="/projects/show/{{$project->id}}" class="border-card-2 project-icon">
			    	<img src="{{$project->thumbnailURL}}" class="cover card-img-top" id="imgCardRI" alt="caminho do arquivo de imagem">
			    
			    @elseif($project->type == 3)
				
					<a href="/projects/show/{{$project->id}}" class="border-card-3 project-icon">
						<figure class="efect">
							<img src="/storage/icons/siteStyle.jpg" class="cover subscreen card-img-top" alt="">
							<figcaption>
								<img width="100" height="70" src="/storage/icons/html.png" alt="codigo html css javascript">
							</figcaption>	
						</figure>
			 	@endif
			    </a>
			    
			    <div class="card-body">

			      <div class="profileThumbHome pt-2 fl">
			      	<a href="/projects/userProject/{{$project->user->id}}">
				      	@if($project->user->image == null)
				  			<img src="/storage/users/user.png" class="userThumb" alt="foto default para usuarios">
				  		@else
				  			<img src="/storage/{{$project->user->image}}" class="userThumb" alt="imagem do usuário">
				  		@endif
				  	</a>
			      </div>

			      <div class="fl">
			      	<h3 class="projectNameControll">
			      		{{$project->title}}
					</h3>

			      	<br />

			      	<a href="/projects/userProject/{{$project->user->id}}">
				      	<span class="nameControll">
				      		{{$project->user->name}}
				      	</span>
					</a>
					
					<div class="my-2">
						<h4 class="mx-1">{{ $project->extension }}</h4>
					</div>
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
