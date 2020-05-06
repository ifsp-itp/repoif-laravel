<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('title');
            $table->string('project');
            $table->string('download')->nullable();
            $table->text('description');
            $table->string('extension')->nullable();
            $table->integer('sent')->nullable();
            $table->integer('type');
            $table->integer('file_type')->nullable();
            $table->integer('zip_default')->nullable();
            $table->date('date');
            $table->text('path_web')->nullable();
            $table->integer('views');
            $table->timestamps();

            $table->string('thumbnailURL')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
