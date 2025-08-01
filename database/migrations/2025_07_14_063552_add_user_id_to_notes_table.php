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
        Schema::create('comments', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('note_id')->constrained()->onDelete('cascade'); // if comments are on notes
        $table->text('content');
        $table->timestamps();
    });

    }




    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    Schema::table('notes', function (Blueprint $table) {
        $table->dropForeign(['user_id']);
        $table->dropColumn('user_id');
        });
    }
};
