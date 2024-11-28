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
        Schema::create('item_requisition', function (Blueprint $table) {
            $table->id();
            $table->foreignID('item_id')->constrained();
            $table->foreignID('requisition_id')->constrained();
            $table->integer('quantity')->default(0);
            $table->string('quantity_unit')->nullable();
            $table->integer('in_pcs')->default(0);
            $table->integer('ho_ctrl_start')->nullable();
            $table->integer('ho_ctrl_end')->nullable();
            $table->text('coc_prefix')->nullable();
            $table->integer('series_start')->nullable();
            $table->integer('series_end')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_requisition');
    }
};
