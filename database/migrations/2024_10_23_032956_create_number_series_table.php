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
        Schema::create('number_series', function (Blueprint $table) {
            $table->id();
            $table->foreignID('requisition_id')->constrained();
            $table->string('branch_code')->nullable();
            $table->string('branch_name')->nullable();
            $table->foreignID('item_id')->constrained();
            $table->string('item_code')->nullable();
            $table->string('coc_prefix')->nullable();
            $table->integer('number'); // This will hold the sequential number
            $table->string('number_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('number_series');
    }
};
