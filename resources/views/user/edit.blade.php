@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar Usuario</div>

                <div class="card-body">
                    <form method="post" action="{{ route('user.update' , ['id' => $user->id]) }}" enctype="multipart/form-data">

                        @method('PUT')
                        @csrf
                        
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="course" class="col-md-4 col-form-label text-md-right">{{ __('Course') }}</label>
                            <div class="col-md-6">
                              <select class="custom-select" id="inputGroupSelect01" name="course" value="{ $user->course}">
                                <option value="EDIFICAÇÕES">Edificações</option>
                                <option value="ENGENHARIA MECÂNICA">Engenharia Mecânica</option>
                                <option value="ESPECIALIZAÇÃO EM INFORMÁTICA APLICADA À EDUCAÇÃO">Especialização em Informática Aplicada à Educação</option> 
                                <option value="FÍSICA">Física</option>
                                <option value="INFORMÁTICA">Informática</option>
                                <option value="INTEGRADO ELETROMECÂNICA">Integrado Eletromecânica</option>
                                <option value="INTEGRADO INFORMÁTICA">Integrado Informática</option>
                                <option value="FORMAÇÃO PEDAGÓGICA">Formação Pedagógica</option>
                                <option value="MATEMÁTICA">Matemática</option>
                                <option value="MECÂNICA">Mecânica</option>
                              </select>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>

                     
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


