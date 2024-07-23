<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rules\Unique;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('casted_votes', function (Blueprint $table) {
            $table->id();
            $table->string('reference_key')->unique();

            $table->string('governor')->nullable();
            $table->string('vice_governor')->nullable();
            $table->string('secretary')->nullable();
            $table->string('associate_secretary')->nullable();
            $table->string('treasurer')->nullable();
            $table->string('associate_treasurer')->nullable();
            $table->string('auditor')->nullable();
            $table->string('public_relation_officer')->nullable();
            $table->string('2nd_year_rep')->nullable();
            $table->string('3rd_year_rep')->nullable();
            $table->string('4th_year_rep')->nullable();

            $table->string('president')->nullable();
            $table->string('vice_president')->nullable();
            $table->string('senators')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::drop('casted_votes');
    }
};
