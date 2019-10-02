@extends('layouts.app')

@section('content')

@if ($user->id == auth()->id() || auth()->id() == '1')

<div class="container emp-profile">
            <form method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">

                            @if($user->image == NULL)
                            <img src="/storage/users/profile.jpg" alt=""/>
                            @else
                            <img src="/storage/users/{{$user->image}}" alt=""/>
                            @endif

                            @if(auth()->id() == $user->id)
                            <div class="file btn btn-lg btn-primary">
                                Selecione sua foto
                                <input type="file" name="file"/>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                                    <h4>
                                        {{$user->name}}
                                    </h5>
                                    <h6>
                                        {{$user->course}}
                                    </h6>

                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item marginProfile">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Sobre</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    @if(auth()->id() == $user->id)
                    <div class="col-md-2">
                        <a href="/user/edit/{{ $user->id }}" class="profile-edit-btn" name="btnAddMore">
                            <button type="button" class="btn btn-outline-success">
                                Editar Informações
                            </button>
                        </a>
                    </div>
                    @endif
                    
                </div>
                <div class="row">
                    <div class="col-md-4">

                        <div class="profile-work">

                            <ul class="list-group">
                                <li class="list-group-item text-muted">Atividade <i class="fa fa-dashboard fa-1x"></i></li>
                                <li class="list-group-item text-right">
                                    <span class="pull-left">
                                        <strong>
                                            Curtidas  
                                        </strong>
                                    </span>
                                    <i class="fa fa-thumbs-o-up"></i>
                                     13
                                </li>
                                <li class="list-group-item text-right">
                                    <span class="pull-left">
                                        <strong>
                                            Projetos Criados
                                        </strong>  
                                    </span> 
                                    <i class="fa fa-clipboard"></i>
                                     37
                                </li>
                                <li class="list-group-item text-right">
                                    <span class="pull-left">
                                        <strong>
                                            Cometários Recebidos
                                        </strong>
                                    </span>
                                    <i class="fa fa-comments-o"></i>
                                     78
                                </li>
                              </ul>
 

                            <p>LINKS UTEIS</p>
                            <a href="https://www.ifsp.edu.br/">IFSP</a><br/>
                            <a href="https://itp.ifsp.edu.br/">IFSP ITAPE</a><br/>
                            <a href="https://suap.ifsp.edu.br/accounts/login/?next=/">SUAP</a><br/>
                            <a href="https://moodle.itp.ifsp.edu.br/">MOODLE</a><br/>
                            <a href="http://pergamum.biblioteca.ifsp.edu.br/">PERGAMUM</a>
                            
                            
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="tab-content profile-tab userInfo" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>ID</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$user->id}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Nome</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$user->name}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$user->email}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Curso</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$user->course}}</p>
                                            </div>
                                        </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>           
        </div>
@else
    <link href='https://fonts.googleapis.com/css?family=Anton|Passion+One|PT+Sans+Caption' rel='stylesheet' type='text/css'>
<body>

        <!-- Error Page -->
            <div class="error">
                <div class="container-floud">
                    <div class="col-xs-12 ground-color text-center">
                        <div class="container-error-404">
                            <div class="clip"><div class="shadow"><span class="digit thirdDigit"></span></div></div>
                            <div class="clip"><div class="shadow"><span class="digit secondDigit"></span></div></div>
                            <div class="clip"><div class="shadow"><span class="digit firstDigit"></span></div></div>
                            <div class="msg">OH!<span class="triangle"></span></div>
                        </div>
                        <h2 class="h1">Sorry! Page not found</h2>
                    </div>
                </div>
            </div>
        <!-- Error Page -->
</body>

@endif
@endsection