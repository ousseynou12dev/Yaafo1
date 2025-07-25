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
    $table->unsignedBigInteger('alert_id')->nullable()->after('user_id');
    $table->foreign('alert_id')->references('id')->on('alerts')->onDelete('cascade');
});

}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projets', function (Blueprint $table) {
            //
        });
    }
};
