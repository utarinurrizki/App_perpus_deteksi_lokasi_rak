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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 255);
            $table->string('pengarang', 255);
            $table->string('penerbit', 255);
            $table->string('isbn', 30)->nullable(); 
            $table->string('jumlah_halaman, 100')->nullable(); 
            $table->integer('jumlah_buku')->default(0);
            $table->enum('status', [
                'tersedia',
                'tidak tersedia'
            ])->default('tersedia');
            $table->string('edisi', 50)->nullable(); 
            $table->year('tahun')->nullable();
            $table->string('kategori', 100)->nullable();

            // Relasi ke racks
            $table->foreignId('rak_id')
                  ->constrained('racks')
                  ->onDelete('cascade');

            $table->string('cover', 255)->nullable();

            $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
