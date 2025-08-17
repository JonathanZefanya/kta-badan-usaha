<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('badan_usahas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pj');
            $table->string('bentuk_badan_usaha');
            $table->string('jenis_badan_usaha');
            $table->string('npwp_bu');
            $table->string('email_bu');
            $table->string('telepon_bu');
            $table->string('kode_pos_bu');
            $table->text('alamat_bu');
            $table->string('provinsi');
            $table->string('kab_kota');
            $table->string('pjbu');
            $table->string('kualifikasi');
            $table->string('photo_pjbu')->nullable();
            $table->string('npwp_bu_file')->nullable();
            $table->string('nib_file')->nullable();
            $table->string('ktp_pjbu_file')->nullable();
            $table->string('npwp_pjbu_file')->nullable();
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('badan_usahas');
    }
};
