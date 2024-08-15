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
        Schema::table('components', function (Blueprint $table) {
            $table->string('qr_code')->nullable();
        });
        Schema::table('consumables', function (Blueprint $table) {
            $table->string('qr_code')->nullable();
        });
        Schema::table('depreciations', function (Blueprint $table) {
            $table->string('qr_code')->nullable();
        });
        Schema::table('hardware', function (Blueprint $table) {
            $table->string('qr_code')->nullable();
        });
        Schema::table('licences', function (Blueprint $table) {
            $table->string('qr_code')->nullable();
        });
        Schema::table('maintenances', function (Blueprint $table) {
            $table->string('qr_code')->nullable();
        });
        Schema::table('people', function (Blueprint $table) {
            $table->string('qr_code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tables', function (Blueprint $table) {
            //
        });
    }
};
