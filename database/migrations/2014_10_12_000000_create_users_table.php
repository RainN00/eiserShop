<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'users',
            function (Blueprint $table) {
                $table->id();
                $table->string('email')->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->string('firstname')->nullable();
                $table->string('lastname')->nullable();
                $table->string('avatar')->nullable();
                $table->string('address')->nullable();
                $table->string('phone')->nullable();
                $table->unsignedBigInteger('role_id');
                $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade')->default(2);
                $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
