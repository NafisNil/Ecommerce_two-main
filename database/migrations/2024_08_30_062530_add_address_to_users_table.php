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
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('postcode')->nullable();
            $table->string('state')->nullable();


            $table->string('scountry')->nullable();
            $table->string('scity')->nullable();
            $table->string('spostcode')->nullable();
            $table->string('sstate')->nullable();
            $table->string('saddress')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
