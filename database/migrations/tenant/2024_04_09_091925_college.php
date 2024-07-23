<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('college', function (Blueprint $table) {
            $table->id();
            $table->string('college_id')->unique();
            $table->string('name');
            $table->string('acronym');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::drop('college');
    }
};
