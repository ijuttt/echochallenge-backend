<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
<<<<<<< HEAD:database/migrations/2025_07_02_160456_create_quests_table.php
    public function up(): void
    {
        Schema::create('quests', function (Blueprint $table) {
            $table->id();
            $table->string('quest', 1000);
            $table->unsignedInteger('point');
            $table->timestamps();
        });
    }
=======
    public function up()
{
    Schema::create('daily_quests', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('description');
        $table->integer('point');
        $table->timestamps();
    });
}

>>>>>>> 6c0aa6107744001eb7fd7cca8c52b4d9601e6763:database/migrations/2025_07_02_160456_create_daily_quests_table.php

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_quests');
    }
};
