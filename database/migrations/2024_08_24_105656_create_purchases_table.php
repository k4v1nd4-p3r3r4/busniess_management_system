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
            $table->string('purchase_id')->primary(); // Primary key as string
            $table->string('material_id');
            $table->foreign('material_id')
                ->references('material_id')
                ->on('materials')
                ->onDelete('cascade'); // Foreign key to materials table

            $table->string('supplier_id');
            $table->foreign('supplier_id')
                ->references('supplier_id')
                ->on('suppliers')
                ->onDelete('cascade'); // Foreign key to suppliers table

            $table->date('date');
            $table->double('qty');
            $table->double('unit_price');
            $table->double('total_amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
