<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('badan_usaha_id');
            $table->unsignedBigInteger('user_id');
            $table->string('nomor_invoice')->unique();
            $table->decimal('nilai', 15, 2);
            $table->string('status')->default('Belum Dibayar');
            $table->timestamps();

            $table->foreign('badan_usaha_id')->references('id')->on('badan_usahas')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('invoices');
    }
};
