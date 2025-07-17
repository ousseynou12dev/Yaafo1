<?php
// database/migrations/xxxx_xx_xx_add_category_id_to_alerts_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
{
    Schema::table('alerts', function (Blueprint $table) {
        $table->foreignId('category_id')
              ->nullable()
              ->constrained()
              ->onDelete('cascade');
    });
}


    public function down(): void
    {
        Schema::table('alerts', function (Blueprint $table) {
            if (Schema::hasColumn('alerts', 'category_id')) {
                $table->dropForeign(['category_id']);
                $table->dropColumn('category_id');
            }
        });
    }
};
