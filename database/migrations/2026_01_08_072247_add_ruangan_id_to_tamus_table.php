<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tamus', function (Blueprint $table) {
            $table->foreignId('ruangan_id')->nullable()->constrained('ruangans')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('tamus', function (Blueprint $table) {
            //
        });
    }
};
