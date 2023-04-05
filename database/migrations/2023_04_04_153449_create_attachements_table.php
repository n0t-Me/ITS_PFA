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
        Schema::create('attachements', function (Blueprint $table) {
          $table->id();
          $table->string('name');
          $table->text('path')->unique();
          $table->unsignedBigInteger('issue_id')->nullable();
          $table->unsignedBigInteger('comment_id')->nullable();
          $table->foreign('issue_id')->references('id')->on('issues');
//          $table->foreign('owner_id')->references('id')->on('comments');
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attachements');
    }
};
