<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');

            $table->unsignedBigInteger('user_id'); // El usuario que crea el reporte
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('delegate_id');
            $table->foreign('delegate_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('report_id')->nullable();

            $table->string('title');
            $table->text('content')->nullable();
            $table->text('evidence')->nullable();
            $table->string('value');
            $table->string('state');
            $table->longText('comment');

            $table->boolean('look')->default(false);
            $table->boolean('image');
            $table->boolean('video');
            $table->boolean('file');
            $table->string('count')->nullable();
            $table->boolean('repeat')->default(false);

            $table->integer('hours_quote')->nullable();
            $table->dateTime('progress')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
