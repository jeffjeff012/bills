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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->text('content');
            
            // Consolidated fields
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('authored_by')->nullable();
            $table->date('due_date')->nullable();

            $table->string('image')->nullable();
            $table->unsignedInteger('likes')->default(0);
            $table->unsignedInteger('dislikes')->default(0);
            
            $table->string('attachment')->nullable(); // For PDF uploads
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
