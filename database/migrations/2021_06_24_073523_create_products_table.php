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
        Schema::create(
            'products',
            function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('thumbnail');
                $table->text('content');
                $table->string('short_description');
                $table->integer('quantity');
                $table->integer('views')->nullable();
                $table->float('price');
                $table->integer('sold')->nullable();
                $table->unsignedBigInteger('category_id');
                $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
                $table->unsignedBigInteger('brand_id');
                $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
                $table->unsignedBigInteger('nation_id');
                $table->foreign('nation_id')->references('id')->on('nations')->onDelete('cascade');
                $table->tinyInteger('status');
                $table->timestamps();
            }
        );
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
