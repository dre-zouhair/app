<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnterpriseFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enterprise_fields', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("enterprise_id");
            $table->foreign('user_id')->references('id')->on('enterprises');
            $table->unsignedBigInteger("field_id");
            $table->foreign('field_id')->references('id')->on('fields');
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
        Schema::dropIfExists('enterprise_fields');
    }
}
