@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

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
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                              <select class="custom-select" id="inputGroupSelect01" name="course">
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
                        <div class="row py-2 my-2">
                            <input type="file" name="userimage" onChange="teste()" id="validImage">
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">

                                <button type="submit" id="valid" class="btn btn-success">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <br /> 
                        <a href="{{ url('/auth/redirect/facebook') }}" class="btn btn-primary">
                            <i class="fab fa-facebook-square"> facebook</i> 
                        </a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function teste() {
        var imageinput = window.document.getElementById('validImage')
        if(imageinput != ""){
            var num = imageinput.value.length

            var newnovo = num - 4
            var newout = num - 5
            var imageo = imageinput.value.slice(newout, num)
 
            var image =  imageinput.value.slice(newnovo, num)

            if(image == '.jpg'){
                document.getElementById('valid').removeAttribute('class', 'd-none')
                document.getElementById('valid').setAttribute('class', 'btn btn-success')
            }else if(image == '.png'){
                document.getElementById('valid').removeAttribute('class', 'd-none')
                document.getElementById('valid').setAttribute('class', 'btn btn-success')
            }else if(imageo == '.jpeg'){
                document.getElementById('valid').removeAttribute('class', 'd-none')
                document.getElementById('valid').setAttribute('class', 'btn btn-success')
              
            }else{
                document.getElementById('valid').setAttribute('class', 'd-none')
                alert('informe uma extensão valida!!!')
            }
        }
    }
   
</script>
@endsection
