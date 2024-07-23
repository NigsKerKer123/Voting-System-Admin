<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->string('student_id')->unique();
            $table->string('picture_id')->unique();
            $table->string('name');
            $table->string('course');

            $table->string('college');
            $table->string('organization');
            $table->string('partylist');
            $table->string('position');

            $table->string('college_id');
            $table->string('organization_id');
            $table->string('partylist_id');
            $table->string('position_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::drop('candidates');
    }
};
