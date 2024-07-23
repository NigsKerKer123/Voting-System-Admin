<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customization', function (Blueprint $table) {
            $table->id();
            $table->string('logo_name')->nullable();
            $table->string('logo_pic')->nullable();
            $table->timestamps();
        });

        DB::table('customization')->insert([
            'logo_name' => null,
            'logo_pic' => null,
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('customization');
    }
};
