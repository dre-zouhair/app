<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->string("desc");
            $table->date("depositDate");
            $table->date("expirationDate");
            $table->unsignedBigInteger("enterprise_id");
            $table->foreign('user_id')->references('id')->on('enterprises');
            $table->unsignedBigInteger("student_id");
            $table->foreign('student_id')->references('id')->on('students');
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
        Schema::dropIfExists('submissions');
    }
}
