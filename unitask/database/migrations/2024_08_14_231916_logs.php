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
        Schema::create('Logs', function (Blueprint $table) {
            $table->bigIncrements('ID_LOG');
            $table->string('NOME', 50);
            $table->string('IP_REQUEST', 50);
            $table->string('REQUEST', 150);
            $table->json('RESPONSE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Logs');
    }
};
