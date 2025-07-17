<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('commentaires', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('alerte_id'); // clé étrangère vers alerts
            $table->string('auteur'); // nom de la personne qui commente
            $table->text('texte');    // contenu du commentaire
            $table->timestamps();

            // Clé étrangère
            $table->foreign('alerte_id')->references('id')->on('alerts')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('commentaires');
    }
};
