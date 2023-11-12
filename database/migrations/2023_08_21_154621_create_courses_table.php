<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('course_name');
            $table->string('slug');
            $table->string('instructor_name');
            $table->float('price');
            $table->string('difficulties');
            $table->integer('language_id');
            $table->string('course_type');
            $table->integer('grade_id');
            $table->integer('course_status');
            $table->integer('intro_video');
            $table->string('video_link')->nullable();
            $table->longText('short_description');
            $table->longText('long_description');
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
        Schema::dropIfExists('courses');
    }
};
