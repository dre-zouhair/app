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
            $table->boolean("state")->default(true);
            $table->unsignedBigInteger("internship_id");
            $table->foreign('internship_id')->references('id')->on('internships');
            $table->unsignedBigInteger("intern_id");
            $table->foreign('intern_id')->references('id')->on('interns');
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
