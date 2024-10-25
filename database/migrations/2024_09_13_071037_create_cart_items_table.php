<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')->constrained('carts')->onDelete('cascade'); // Link item to cart
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Link item to product
            $table->integer('quantity')->default(1); // Quantity of the product in the cart
            $table->string('size')->nullable(); // Store selected size
            $table->string('color')->nullable(); // Store selected color
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
        Schema::dropIfExists('cart_items');
    }
};
