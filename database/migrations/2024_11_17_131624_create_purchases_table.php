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
        Schema::create('purchases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('supplier_id');
            $table->date('purchase_date');
            $table->double('total_price');
            $table->boolean('status');
            $table->foreign('supplier_id')
                ->references('id')->on('suppliers')
                ->onDelete('cascade');
            $table->timestamps();
        });

        DB::update("ALTER TABLE purchases AUTO_INCREMENT = 1000;");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
