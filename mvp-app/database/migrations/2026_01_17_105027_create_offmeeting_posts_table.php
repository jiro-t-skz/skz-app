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
        Schema::create('offmeeting_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title',255);
            $table->text('body');
            $table->date('date')->nullable();
            $table->string('prefecture',50)->nullable();
            $table->string('place',255)->nullable();
            $table->unsignedSmallInteger('capacity')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['prefecture', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offmeeting_posts');
    }
};
