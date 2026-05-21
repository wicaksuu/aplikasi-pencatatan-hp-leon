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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->string('no_order');
            $table->string('nomor_va')->nullable();
            $table->integer('qty')->default(1);
            $table->decimal('harga', 15, 2);
            $table->enum('platform', ['Akulaku', 'Tokopedia', 'Lazada', 'Tiktok', 'Blibli']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
