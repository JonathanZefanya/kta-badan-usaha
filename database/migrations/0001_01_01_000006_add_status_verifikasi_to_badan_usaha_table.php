<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::table('badan_usahas', function (Blueprint $table) {
            $table->string('status_verifikasi')->default('Belum Diverifikasi');
        });
    }
    public function down() {
        Schema::table('badan_usahas', function (Blueprint $table) {
            $table->dropColumn('status_verifikasi');
        });
    }
};
