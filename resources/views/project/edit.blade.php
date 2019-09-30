@extends('layouts.app')

@section('content')

@if ($project->user_id == auth()->id() || auth()->id() == '1')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar Projeto</div>

                <div class="card-body">
                    <form method="post" action="/projects/show/{{ $project->id }}" enctype="multipart/form-data">

                        @method('PUT')
                        @csrf

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Titulo:') }}</label>

                            <div class="col-md-6">
                                <input type="text" name="title" maxlength="34" value="{{ $project->title }}">

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Descrição do projeto:') }}</label>

                            <div class="col-md-6">
                                <textarea name="description" class="formsEdit" style="height: 100px;">
                                    {{ $project->description }}
                                </textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Tipo do projeto:') }}</label>

                            <div class="col-md-6">
                                <select name="type">
                                  <option value="1">Foto</option>
                                  <option value="2">Vídeo</option>
                                  <option value="3">Código</option>
                            </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div></div>
                            <label for="file" class="col-md-4 col-form-label text-md-right">{{ __('Arquivo:') }}</label>
                            <div class="col-md-6">
                              <img src="/storage/files/{{$project->project}}" class="formsEdit">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-outline-success">
                                    {{ __('Atualizar') }}
                                </button>
                            </div>
                        </div>                       
                    </form>
                </div>
            </div>
        </div>
    </div>
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


