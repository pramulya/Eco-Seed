<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id('cartId');
            $table->unsignedBigInteger('product_id');
            $table->decimal('total_price', 10, 2);
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
