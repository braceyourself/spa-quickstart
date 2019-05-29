<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApiResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_resources', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('api_id');
            $table->string('resource');
            $table->string('store_in_table')->nullable();
            $table->boolean('enabled')->default(true);
            $table->integer('failed_attempts')->default(0);

            $table->unique(['api_id','resource']);

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
        Schema::dropIfExists('api_resources');
    }
}
