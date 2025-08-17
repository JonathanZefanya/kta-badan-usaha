<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('badan_usaha_id');
            $table->unsignedBigInteger('user_id');
            $table->string('metode');
            $table->string('bukti_pembayaran');
            $table->string('status')->default('Menunggu Verifikasi');
            $table->timestamps();
            $table->foreign('badan_usaha_id')->references('id')->on('badan_usahas')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
