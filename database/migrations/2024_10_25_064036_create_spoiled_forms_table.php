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
        Schema::create('spoiled_forms', function (Blueprint $table) {
            $table->id();
            $table->timestamp('spoiled_date');
            $table->string('spoiled_no');
            $table->foreignID('user_id')->constrained();
            $table->foreignID('item_id')->constrained();
            $table->integer('quantity')->default(0);
            $table->string('spoiled_reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spoiled_forms');
    }
};
