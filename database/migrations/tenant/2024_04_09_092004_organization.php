<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('organization', function (Blueprint $table) {
            $table->id();
            $table->string('organization_id');
            $table->string('name');
            $table->string('acronym');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::drop('organization');
    }
};
