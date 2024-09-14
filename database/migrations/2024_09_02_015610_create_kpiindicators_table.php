<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kpiindicators', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by');
            $table->foreign('created_by')->references('id')->on('users');
            $table->string('indicator_name');
            $table->string('description');
            $table->foreignId('tupoksi_id');
            $table->foreign('tupoksi_id')->references('id')->on('tupoksis');
            $table->foreignId('programkerja_id');
            $table->foreign('programkerja_id')->references('id')->on('programkerjas');
            $table->foreignId('restra_id');
            $table->foreign('restra_id')->references('id')->on('renstras');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kpiindicators');
    }
};
