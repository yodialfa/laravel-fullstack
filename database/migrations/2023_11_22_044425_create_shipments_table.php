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
        Schema::create('shipments', function (Blueprint $table) {
            // $table->id();
            $table->foreignId('agen_id');
            $table->foreignId('cabang_id');
            $table->string('ship_id', 20);
            $table->string('nopol', 20)->default('D11111AB');
            $table->string('pic', 20)->default('admin');
            $table->string('status', 2);
            $table->string('tujuan');
            $table->string('kecTujuan')->default(0);

            $table->index('ship_id');
            $table->timestamps();

            // $table->foreign('ship_id')->references('ship_id')->on('detail_shipments')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};
