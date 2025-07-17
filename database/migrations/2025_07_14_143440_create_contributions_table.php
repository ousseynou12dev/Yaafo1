<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContributionsTable extends Migration
{
    public function up()
    {
        Schema::create('contributions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('projet_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');

            $table->bigInteger('montant')->unsigned();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('contributions');
    }
}
