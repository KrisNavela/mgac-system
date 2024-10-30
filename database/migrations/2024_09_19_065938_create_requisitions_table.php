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
        Schema::create('requisitions', function (Blueprint $table) {
            $table->id();
            $table->string('req_no');
            $table->timestamp('req_date');
            $table->string('status')->default('pending');
            $table->foreignID('user_id')->constrained();
            $table->string('type_request');
            $table->string('replenishment_month')->nullable();
            $table->string('replenishment_year')->nullable();
            $table->string('bonds_status')->default('No');
            $table->timestamp('bonds_date')->nullable();
            $table->string('uw_status')->default('No');
            $table->timestamp('uw_date')->nullable();
            $table->string('collasst_status')->default('No');
            $table->timestamp('collasst_date')->nullable();
            $table->string('collmanager_status')->default('No');
            $table->timestamp('collmanager_date')->nullable();
            $table->string('finalapproval_status')->default('For Approval');
            $table->timestamp('finalapproval_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requisitions');
    }
};
