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
        Schema::table('consumables', function (Blueprint $table) {
            $table->integer('threshold')->default(0);
        });

        Schema::table('components', function (Blueprint $table) {
            $table->integer('threshold')->default(0);
        });

        Schema::table('licences', function (Blueprint $table) {
            $table->integer('threshold')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('consumables', function (Blueprint $table) {
            //
        });
    }
};
