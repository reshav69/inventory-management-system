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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products');
            $table->foreignId('warehouse_id')->constrained('warehouses');
            $table->integer('quantity');
            $table->decimal('total_amount',10,2);
            $table->string('sale_date');
            $table->bigInteger('customer_phone_number')->nullable();
            $table->string('customer_full_name')->nullable();
            $table->string('customer_extra_info')->nullable();

            //+5
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->string('created_at');
            $table->string('updated_at')->nullable();
            $table->string('deleted_at')->nullable();
            // $table->softDeletes();
            // $table->timestamps();
        });
    }
    
    /**
    * Reverse the migrations.
    */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
