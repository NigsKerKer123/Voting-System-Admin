<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ssc_votes', function (Blueprint $table) {
            $table->id();
            $table->string('student_id')->unique();
            $table->string('name');
            $table->string('president')->nullable();
            $table->string('vice_president')->nullable();
            $table->string('senators')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::drop('ssc_votes');
    }
};
