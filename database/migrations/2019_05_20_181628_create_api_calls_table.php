<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApiCallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_calls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('api_resource_id');
            $table->enum('method',['GET','POST','PATCH','PUT','DELETE']);
            $table->boolean('status')->nullable();
            $table->json('response')->nullable();
            $table->json('request');
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
        Schema::dropIfExists('api_calls');
    }
}
