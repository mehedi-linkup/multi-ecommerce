<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
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
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('brand_id')->unsigned();
            $table->bigInteger('category_id')->unsigned();
            $table->bigInteger('subcategory_id')->unsigned();
            $table->bigInteger('subsubcategory_id')->unsigned();
            $table->string('name_en');
            $table->string('name_bn');
            $table->string('slug_en');
            $table->string('slug_bn');
            $table->string('product_code');
            $table->unsignedInteger('quantity');
            $table->string('tag_en');
            $table->string('tag_bn');
            $table->text('short_desc_en');
            $table->text('short_desc_bn');
            $table->longText('long_desc_en');
            $table->longText('long_desc_bn');
            $table->string('size_en')->nullable();
            $table->string('size_bn')->nullable();
            $table->string('color_en')->nullable();
            $table->string('color_bn')->nullable();
            $table->decimal('selling_price');
            $table->decimal('discount_price')->nullable();
            $table->string('product_image');
            $table->boolean('hot_deals')->nullable();
            $table->boolean('featured')->nullable();
            $table->boolean('special_offer')->nullable();
            $table->boolean('special_deals')->nullable();
            $table->tinyInteger('status')->default(0);
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
}
