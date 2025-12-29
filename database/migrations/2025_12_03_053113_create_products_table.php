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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('description');
            $table->string('key')->unique();
            $table->decimal('price',10,2);
            // $table->integer('quantity');
            $table->string('barcode')->unique()->nullable();
            $table->string('image_path')->nullable();
            //+6
            $table->boolean('status')->default(0);
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->string('created_at_bs');
            $table->string('updated_at_bs')->nullable();
            $table->string('deleted_at_bs')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
