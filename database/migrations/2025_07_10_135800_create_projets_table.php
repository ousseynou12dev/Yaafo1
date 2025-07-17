<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('projets', function (Blueprint $table) {
    $table->id();
    $table->string('title'); // anglais
    $table->text('description');
    $table->string('image')->nullable();
    $table->decimal('objectif', 12, 2);
    $table->decimal('recolte', 12, 2)->default(0);
    $table->string('quartier')->nullable();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->foreignId('alerte_id')->nullable()->constrained('alerts')->onDelete('set null');
    $table->boolean('approuve')->default(false);
    $table->timestamps();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('projets');
    }
};
