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
        Schema::create('chapters', function (Blueprint $table) {
            $table->id('idchapitre');
            $table->string('nomchapitre');  
            $table->unsignedBigInteger('idformateur');  
            $table->unsignedBigInteger('idmodule'); 
            $table->timestamps();

            $table->foreign('idformateur')->references('idformateur')->on('formateurs');  
            $table->foreign('idmodule')->references('idmodule')->on('modules');  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chapters');
    }
};
