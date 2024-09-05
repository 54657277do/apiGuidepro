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
        Schema::create('qcm', function (Blueprint $table) {
            $table->id('idqcm');
            $table->unsignedBigInteger('idformateur');  
            $table->unsignedBigInteger('idchapitre');
            $table->unsignedBigInteger('idmodule');
            $table->string('imgqcm');
            $table->string("libelle");
            $table->string('option1');
            $table->string('option2');
            $table->string('option3');
            $table->string('reponse');
            $table->timestamps();

            $table->foreign('idformateur')->references('idformateur')->on('formateurs');  
            $table->foreign('idchapitre')->references('idchapitre')->on('chapters'); 
            $table->foreign('idmodule')->references('idmodule')->on('modules');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('qcm');
    }
};
