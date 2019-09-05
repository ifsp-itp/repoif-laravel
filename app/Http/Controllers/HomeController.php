<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


/*
Instalar o GIT

Caso precise de uma nova copia do projeto (abrir em outra maquina)
#git clone https://github.com/ifsp-itp/repoif-laravel.git

Pra funcionar o projeto do laravel..
tem que rodar o comando do composer para instalar as dependencias do projeto
#composer install 


Sincronizar o projeto local com o projeto remoto (github)
git pull

Apos modificacoes no projeto (alteracao de arquivos)
#git commit -a -m "sua mensagem de commit"

Mandar as alteracoes para o repositorio central (github)
#git push origin master





*/

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function legal() {
        return view("legal");
    }


}
