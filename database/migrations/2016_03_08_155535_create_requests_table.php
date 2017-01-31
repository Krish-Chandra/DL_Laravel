<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('book_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->date('request_date');
            $table->timestamps();

            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');        
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('requests');
    }
}
