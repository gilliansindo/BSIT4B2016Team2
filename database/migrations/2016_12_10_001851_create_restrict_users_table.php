<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestrictUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restrict_users', function (Blueprint $table) {
            $table->integer('post_id')->unsigned();
            $table->foreign('post_id')
                  ->references('id')->on('posts')
                  ->onDelete('cascade');
            $table->integer('restrict_users_id')->unsigned();
            $table->foreign('restrict_users_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restrict_users');
    }
}
