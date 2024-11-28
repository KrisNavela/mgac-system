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
        Schema::create('remarks_requisition', function (Blueprint $table) {
            $table->id();
            $table->foreignID('requisition_id')->constrained();
            $table->text('content');
            $table->foreignID('user_id')->constrained();
            $table->text('role_name')->nullable(); 
            $table->text('approval_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('remarks_requisition');
    }
};
