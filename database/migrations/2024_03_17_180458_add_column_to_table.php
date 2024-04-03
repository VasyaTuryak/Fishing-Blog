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
        Schema::table('photo_to_posts', function (Blueprint $table) {
            $table->boolean('tile_status')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('photo_to_posts', function (Blueprint $table) {
            $table->dropColumn('tile_status');
        });
    }
};
