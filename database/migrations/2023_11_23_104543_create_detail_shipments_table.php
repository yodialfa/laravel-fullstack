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
        Schema::create('detail_shipments', function (Blueprint $table) {
            $table->id();
            $table->char('no_resi', 40);
            // $table->foreignId('ship_id')->constrained('shipments')->onDelete('cascade');
            $table->string('ship_id', 20);
            $table->timestamps();
            $table->foreign('ship_id')->references('ship_id')->on('shipments')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_shipments');
    }
};
