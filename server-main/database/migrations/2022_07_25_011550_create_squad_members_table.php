<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('squad_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('squad_id')->constrained('squads');
            $table->string('name');
            $table->string('role');
            $table->string('email')->unique();
            $table->date('dob');
            $table->text('picture');
            $table->string('phone', 13);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('squad_members');
    }
};
