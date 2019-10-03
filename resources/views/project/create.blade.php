@extends('layouts.app')

@section('content')

 <style>
    .progress { position:relative; width:100%; border: 1px solid #7F98B2; padding: 1px; border-radius: 3px; }
    .bar { background-color: #B4F5B4; width:0%; height:25px; border-radius: 3px; }
    .percent { position:absolute; display:inline-block; top:3px; left:48%; color: #7F98B2;}
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Criar Projeto</div>

                <div class="card-body">
                    <form method="post" id="formProject" action="/projects" enctype="multipart/form-data" class="lef">

						@csrf

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Titulo') }}</label>

                            <div class="col-md-6">
                                <input type="text" name="title" maxlength="34">

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Descrição do projeto') }}</label>

                            <div class="col-md-6">
                                <textarea name="description"></textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Tipo do projeto') }}</label>

                            <div class="col-md-6">
                                <select name="type">
						          <option value="1">Foto</option>
						          <option value="2">Vídeo</option>
						          <option value="3">Código</option>
						    </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="file" class="col-md-4 col-form-label text-md-right">{{ __('Selecionar arquivo: ') }}</label>
                            <div class="col-md-6">
                              <input type="file" name="file" id="file">
                            </div>

                             <div class="progress">
                                <div class="bar progress-bar progress-bar-striped progress-bar-animated"></div >
                                <div class="percent"></div >
                            </div>

                            <div id="status"></div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" name="upload" value="Upload" class="btn btn-success">
                                    {{ __('Enviar projeto') }}
                                </button>
                            </div>
                        </div>                     
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
 
    function validate(formData, jqForm, options) {
        var form = jqForm[0];
        if (!form.file.value) {
            alert('File not found');
            return false;
        }
    }
 
    (function() {
 
    var bar = $('.bar');
    var percent = $('.percent');
    var status = $('#status');
 
    $('form').ajaxForm({
        beforeSubmit: validate,
        beforeSend: function() {
            status.empty();
            var percentVal = '0%';
            var posterValue = $('input[name=file]').fieldValue();
            bar.width(percentVal)
            percent.html(percentVal);
        },
        uploadProgress: function(event, position, total, percentComplete) {
            var percentVal = percentComplete + '%';
            bar.width(percentVal)
            percent.html(percentVal);
        },
        success: function() {
            var percentVal = 'Wait, Saving';
            bar.width(percentVal)
            percent.html(percentVal);
        },
        complete: function(xhr) {
            let resultado = JSON.parse(xhr.responseText);
            status.html(resultado.success);
            //window.location.href = "/projects";
        }
    });
     
    })();
</script>

@endsection
