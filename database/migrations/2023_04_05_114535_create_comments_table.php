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
          $table->text('comment');
          $table->unsignedBigInteger('owner_id');
          $table->unsignedBigInteger('issue_id');
          $table->foreign('owner_id')->references('id')->on('users');
          $table->foreign('issue_id')->references('id')->on('issues');
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
