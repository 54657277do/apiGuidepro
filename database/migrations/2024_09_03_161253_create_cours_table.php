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
        Schema::create('cours', function (Blueprint $table) {
            $table->id('idcours');
            $table->string('imgcours');
            $table->text('contenu');
            $table->unsignedBigInteger('idformateur');  
            $table->unsignedBigInteger('idchapitre'); 
            $table->unsignedBigInteger('idmodule'); 
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
        Schema::dropIfExists('cours');
    }
};
