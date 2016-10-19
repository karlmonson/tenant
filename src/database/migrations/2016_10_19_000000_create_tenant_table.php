<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTenantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenant', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('value')->nullable();
            $table->boolean('is_encrypted')->default(false);
            $table->boolean('is_env')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tenant');
    }
}