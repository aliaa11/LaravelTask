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
            $table->timestamps();
            $table->string('message_prompt');
            $table->foreignId('post_id')->constrained()->nullable()->onDelete('cascade')->onUpdate("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    { 
        Schema::table('comments', function (Blueprint $table) {
        //
        $table->dropForeign("comments_post_id_foreign");
        $table->dropColumn("posts_id");

    });

        Schema::dropIfExists('comments');
    }
};
