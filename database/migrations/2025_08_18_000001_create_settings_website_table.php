<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('settings_website', function (Blueprint $table) {
            $table->id();
            $table->string('nama_website');
            $table->text('signature')->nullable(); // base64 image dari draw area
            $table->string('rekening_nama')->nullable();
            $table->string('rekening_bank')->nullable();
            $table->string('rekening_nomor')->nullable();
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('settings_website');
    }
};
