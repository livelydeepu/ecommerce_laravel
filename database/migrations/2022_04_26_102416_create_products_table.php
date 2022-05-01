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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->onUpdate('cascade')->onDelete('cascade');
            $table->string('name');
            $table->string('image');
            $table->string('slug');
            $table->longText('description');
            $table->longText('short_description');
            $table->foreignId('brand_id')->constrained('brands')->onUpdate('cascade')->onDelete('cascade');
            $table->string('model');
            $table->longText('keywords');
            $table->longText('technical_specification');
            $table->longText('uses');
            $table->longText('warranty');
            $table->string('lead_time');
            $table->foreignId('tax_id')->constrained('taxes')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('is_promo');
            $table->integer('is_featured');
            $table->integer('is_discounted');
            $table->integer('is_trending');
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('products');
    }
};
