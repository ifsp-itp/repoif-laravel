@extends('layouts.app')

@section('content')

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container emp-profile">
            <form method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            <img src="/storage/files/profile.jpg" alt=""/>
                            @if(auth()->id() == $user->id)
                            <div class="file btn btn-lg btn-primary">
                                Change Photo
                                <input type="file" name="file"/>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                                    <h5>
                                        {{$user->name}}
                                    </h5>
                                    <h6>
                                        {{$user->course}}
                                    </h6>
                                    <p class="proile-rating">Total de Likes : <span>##</span></p>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Sobre</a>
                                </li>
                                @if(auth()->id() == $user->id)
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Projetos</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    @if(auth()->id() == $user->id)
                    <div class="col-md-2">
                        <a href="/user/edit/{{ $user->id }}" class="profile-edit-btn" name="btnAddMore">
                            Editar Informações
                        </a>
                    </div>
                    @endif
                    
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-work">
                            <p>LINKS UTEIS</p>
                            <a href="https://www.ifsp.edu.br/">IFSP</a><br/>
                            <a href="https://itp.ifsp.edu.br/">IFSP ITAPE</a><br/>
                            <a href="https://suap.ifsp.edu.br/accounts/login/?next=/">SUAP</a><br/>
                            <a href="https://moodle.itp.ifsp.edu.br/">MOODLE</a><br/>
                            <a href="http://pergamum.biblioteca.ifsp.edu.br/">PERGAMUM</a>
                            <p>Desenvolvedores</p>
                            <a href="">##</a><br/>
                            <a href="">##</a><br/>
                            
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
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
                                                <label>Telefone</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>123 456 7890</p>
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
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                            Projetos blá blá
                                </div>
                        </div>
                    </div>
                </div>
            </form>           
        </div>
@endsection