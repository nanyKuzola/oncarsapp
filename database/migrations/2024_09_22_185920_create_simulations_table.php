<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     *
     *
     * Run simulation migration.
     */
    public function up(): void
    {
        Schema::create('simulations', function (Blueprint $table) {
            $table->id();
            $table->string('nome',15);
            $table->string('sobrenome',15);
            $table->string('endereco',40);
            $table->string('cidade',30);
            $table->string('estado',30);
            $table->string('cep',30);
            $table->integer('score');
            $table->text('status');
            $table->unsignedBigInteger('car_id');
            $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('simulations');
    }
};
