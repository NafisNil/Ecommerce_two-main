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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('order_number', 10)->unique();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->float('sub_total')->default(0);
            $table->float('total_amount')->default(0);
            $table->float('coupon')->default(0)->nullable();
            $table->float('delivery_charge')->default(0)->nullable();
            $table->integer('quantity')->default(0);
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->string('country');
            $table->text('address');
            $table->string('city');
            $table->string('state');
            $table->integer('postcode');
            $table->mediumText('note')->nullable();

            $table->string('sfirst_name');
            $table->string('slast_name');
            $table->string('semail')->nullable();
            $table->string('sphone');
            $table->string('scountry');
            $table->text('saddress');
            $table->string('scity');
            $table->string('sstate');
            $table->integer('spostcode'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
