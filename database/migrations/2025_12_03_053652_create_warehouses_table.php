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
        Schema::create('warehouses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location');
            //+6
            $table->boolean('status')->default(0);
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            // $table->softDeletes();
            // $table->timestamps();
            $table->string('created_at');
            $table->string('updated_at')->nullable();
            $table->string('deleted_at')->nullable();
            
        });
    }
    
    /**
    * Reverse the migrations.
    */
    public function down(): void
    {
        Schema::dropIfExists('warehouses');
    }
};
