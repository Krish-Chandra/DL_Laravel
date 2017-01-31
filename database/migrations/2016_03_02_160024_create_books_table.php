<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('author_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->integer('publisher_id')->unsigned();
            $table->string('isbn');
            $table->integer('total_copies')->unsigned();
            $table->integer('available_copies')->unsigned();
            $table->timestamps();

            $table->foreign('author_id')->references('id')->on('authors')->onDelete('cascade');

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            $table->foreign('publisher_id')->references('id')->on('publishers')->onDelete('cascade');            
        });

        $author = DB::table('authors')->where('authorname', '=', 'Kavi Lakshmi')->value('id');
        $pub = DB::table('publishers')->where('publishername', '=', 'APress')->value('id');
        $cat = DB::table('categories')->where('categoryname', '=', 'PHP')->value('id');

        DB::table('books')->insert(
            array(
                'title' => 'Getting Started with Laravel 5.2',
                'author_id' => $author,
                'category_id' => $cat,
                'publisher_id' => $pub,
                'isbn' => 'X123456',
                'total_copies' => 5,
                'available_copies' => 5
            )
        );        

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->dropForeign(['author_id']);
        $table->dropForeign(['category_id']);        
        $table->dropForeign(['publisher_id']);        

        Schema::drop('books');

    }
}
