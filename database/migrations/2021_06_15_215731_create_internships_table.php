<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInternshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internships', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->string("details");
            $table->date("startDate");
            $table->date("expirationDate");
            $table->string("duration");
            $table->unsignedBigInteger("enterprise_id");
            $table->foreign("enterprise_id")->references("id")->on("enterprises");
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
        Schema::dropIfExists('internships');
    }
}
