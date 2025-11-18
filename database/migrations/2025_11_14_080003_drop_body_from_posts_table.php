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
        Schema::table('posts', function (Blueprint $table) {
            //
            // kalau kolom body ada, hapus
            if (Schema::hasColumn('posts', 'body')) {
                $table->dropColumn('body');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            //
              // rollback: tambahkan lagi body (optional saja)
            $table->longText('body')->nullable();
        });
    }
};
