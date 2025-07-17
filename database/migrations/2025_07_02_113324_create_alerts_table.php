<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * ENUM
     */
   public function up()
{
    Schema::create('alerts', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id'); // qui a créé l'alerte
        $table->string('title'); // titre de l'alerte
        $table->text('description'); // description détaillée
        $table->string('category')->nullable(); // type d'alerte (ex : voirie, sécurité, éclairage...)
        $table->string('status')->default('ouverte'); // ouverte, en cours, résolue
        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alerts');
    }
};
