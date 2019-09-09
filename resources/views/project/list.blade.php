@extends('layouts.app')

@section('content')


	<div class="card-deck">
		@foreach ($projects as $project) 
		  <div class="card mb-3" style="min-width: 19.3rem;">
		  	<a href="/projects/show/{{$project->id}}">
		    	<img src="/storage/files/{{$project->project}}" class="card-img-top" alt="...">
		    </a>
		    <div class="card-body">
		      <h5 class="card-title">{{$project->title}}</h5>
		      <p class="card-text">{{$project->description}}</p>
		    </div>
		    <div class="card-footer">
		      <small class="text-muted"><a href="/user/profile/{{$project->user_id}}" style="float: left;"><img src="/storage/files/userTeste.png" width="40px" height="40px"></a></small>
		     @if($project->likes<=0)

		     @elseif($project->likes<=100)
		      	<img src="/storage/files/tier1.png" width="30px" height="30px" style="float: right;">
		      @elseif($project->likes<=200)
		      	<img src="/storage/files/tier2.png" width="30px" height="30px" style="float: right;">
		      @elseif($project->likes<=300)
		      	<img src="/storage/files/tier3.png" width="30px" height="30px" style="float: right;">
		      @elseif($project->likes<=400)
		      	<img src="/storage/files/tier4.png" width="30px" height="30px" style="float: right;">
		      @elseif($project->likes<=500)
		      	<img src="/storage/files/tier5.png" width="30px" height="30px" style="float: right;">
		      @elseif($project->likes<=600)
		      	<img src="/storage/files/tier6.png" width="30px" height="30px" style="float: right;">
		      @elseif($project->likes<=700)
		      	<img src="/storage/files/tier7.png" width="30px" height="30px" style="float: right;">
		      @elseif($project->likes<=800)
		      	<img src="/storage/files/tier8.png" width="30px" height="30px" style="float: right;">
		      @elseif($project->likes<=900)
		      	<img src="/storage/files/tier9.png" width="30px" height="30px" style="float: right;">
		      @elseif($project->likes<=1000)
		      	<img src="/storage/files/tier10.png" width="30px" height="30px" style="float: right;">
		      @elseif($project->likes<=1100)
		      	<img src="/storage/files/tier11.png" width="30px" height="30px" style="float: right;">
		      @elseif($project->likes<=1200)
		      	<img src="/storage/files/tier12.png" width="30px" height="30px" style="float: right;">
		      @elseif($project->likes<=1300)
		      	<img src="/storage/files/tier13.png" width="30px" height="30px" style="float: right;">
		      @else
		      	<img src="/storage/files/tierMaster.png" width="30px" height="30px" style="float: right;">
		      @endif
		    </div>
		  </div>
		@endforeach
	</div>

	<br>
	<a href="projects/create">CRIAR</a>

	
</div>
@endsection
