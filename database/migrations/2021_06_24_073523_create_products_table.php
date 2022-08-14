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
                $table->integer('views');
                $table->float('price');
                $table->float('number_of_vote_submissions');
                $table->integer('total_vote');
                $table->integer('sold');
                $table->unsignedBigInteger('category_id');
                $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
