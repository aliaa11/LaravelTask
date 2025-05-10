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
        Schema::create('replies', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('comment_id')->nullable()->constrained('comments')->onDelete('cascade')->onUpdate('cascade');
            $table->text('message_prompt'); 
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade'); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('replies');
    }
};
