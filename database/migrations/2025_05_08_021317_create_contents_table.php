<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('contents', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('module_id');
        $table->string('title');
        $table->string('video_type');
        $table->string('video_url');
        $table->string('duration');
        $table->timestamps();

        $table->foreign('module_id')->references('id')->on('modules')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};
