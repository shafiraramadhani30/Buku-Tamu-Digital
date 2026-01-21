<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tamus', function (Blueprint $table) {
            $table->string('alamat')->nullable()->after('nama');
        $table->string('jenis_kelamin')->nullable()->after('alamat');
        $table->string('no_telp')->nullable()->after('jenis_kelamin');
        });
    }

    public function down(): void
    {
        Schema::table('tamus', function (Blueprint $table) {
            $table->dropColumn(['alamat', 'jenis_kelamin', 'no_telp']);
        });
    }
};
