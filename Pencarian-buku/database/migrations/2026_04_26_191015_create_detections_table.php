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
        if (Schema::hasTable('detections')) {
            return;
        }

        Schema::create('detections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rack_id')
                  ->constrained('racks')
                  ->onDelete('cascade'); // kalau rack dihapus, detection ikut hilang

            $table->string('image_result', 255); // hasil gambar YOLO
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detections');
    }
};
