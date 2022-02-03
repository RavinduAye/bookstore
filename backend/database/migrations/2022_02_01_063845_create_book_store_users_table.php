<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookStoreUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_store_users', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('bid');
            $table->String('Title');
            $table->String('Description');
            $table->String('Genre');
            $table->Double('Price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_store_users');
    }
}
