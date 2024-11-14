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
        Schema::create('itemsales', function (Blueprint $table) {

            $table->id('sale_id');
            $table->string('item_id');
            $table->foreign('item_id')
                ->references('item_id')
                ->on('handlists')
                ->onDelete('cascade');

            $table->string('customer_id');
            $table->foreign('customer_id')
                ->references('customer_id')
                ->on('customers')
                ->onDelete('cascade');

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
        Schema::dropIfExists('itemsales');
    }
};
