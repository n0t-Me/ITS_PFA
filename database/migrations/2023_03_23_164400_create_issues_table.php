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
        Schema::create('issues', function (Blueprint $table) {
          $table->id();
          $table->string('title');
          $table->enum('status', ['Open', 'Closed']);
          $table->integer('severity');
          $table->unsignedBigInteger('team_id');
          $table->unsignedBigInteger('owner_id');
          $table->unsignedBigInteger('assignee_id')->nullable();

          $table->foreign('team_id')->references('id')->on('teams');
          $table->foreign('owner_id')->references('id')->on('users');
          $table->foreign('assignee_id')->references('id')->on('users');
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('issues');
    }
};
