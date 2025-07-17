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
    Schema::table('projets', function (Blueprint $table) {
        // $table->bigInteger('objectif')->default(0)->after('description');
        // $table->bigInteger('montant_actuel')->default(0)->after('objectif');
        // $table->boolean('approuve')->default(false)->after('montant_actuel');
    });
}

public function down()
{
    Schema::table('projets', function (Blueprint $table) {
        $table->dropColumn(['objectif', 'montant_actuel', 'approuve']);
    });
}

};
