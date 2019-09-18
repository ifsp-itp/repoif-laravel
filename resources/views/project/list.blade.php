@extends('layouts.app')

@section('content')


	<div class="card-deck">
		@foreach ($projects as $project) 
			<div class="card mb-3 cover">
			  	<a href="/projects/show/{{$project->id}}">
			  		@if($project->type == 2)
			    	<img src="{{$project->thumbnailURL}}" class="cover card-img-top" id="imgCardRI" alt="...">
			    	@else
			    	<img src="storage/files/{{$project->project}}" class="cover card-img-top" id="imgCardRI" alt="...">
			    	@endif
			    </a>
			    
			    <div class="card-body">
			      <h5 class="card-title">{{$project->title}}</h5>
			      <p class="card-text">{{$project->description}}</p>
			    </div>
			    <div class="card-footer">

			      <small class="text-muted fl">
			      	<a href="/projects/userProject/{{$project->user_id}}">
			      		<img src="storage/files/profile.jpg" class="userThumb"> 
			      	</a>
			      </small>

			      <span class="likesControll fl">
			      	{{$project->likes}}
			      </span>
			      	

			     @if($project->likes<=100)
			      	<img src="/storage/files/tier1.png" class="imgDefine fr">
			      @elseif($project->likes<=200)
			      	<img src="/storage/files/tier2.png" class="imgDefine fr">
			      @elseif($project->likes<=300)
			      	<img src="/storage/files/tier3.png" class="imgDefine fr">
			      @elseif($project->likes<=400)
			      	<img src="/storage/files/tier4.png" class="imgDefine fr">
			      @elseif($project->likes<=500)
			      	<img src="/storage/files/tier5.png" class="imgDefine fr">
			      @elseif($project->likes<=600)
			      	<img src="/storage/files/tier6.png" class="imgDefine fr">
			      @elseif($project->likes<=700)
			      	<img src="/storage/files/tier7.png" class="imgDefine fr">
			      @elseif($project->likes<=800)
			      	<img src="/storage/files/tier8.png" class="imgDefine fr">
			      @elseif($project->likes<=900)
			      	<img src="/storage/files/tier9.png" class="imgDefine fr">
			      @elseif($project->likes<=1000)
			      	<img src="/storage/files/tier10.png" class="imgDefine fr">
			      @elseif($project->likes<=1100)
			      	<img src="/storage/files/tier11.png" class="imgDefine fr">
			      @elseif($project->likes<=1200)
			      	<img src="/storage/files/tier12.png" class="imgDefine fr">
			      @elseif($project->likes<=1300)
			      	<img src="/storage/files/tier13.png" class="imgDefine fr">
			      @else
			      	<img src="/storage/files/tierMaster.png" class="imgDefine fr">
			      @endif

			    </div>
			</div>
		@endforeach
	</div>
</div>
@endsection
