<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Duplikat migration, tidak melakukan apa-apa
    }
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
