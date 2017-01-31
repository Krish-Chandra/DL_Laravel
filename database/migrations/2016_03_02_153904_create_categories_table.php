<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('categoryname');
            $table->string('description');
            $table->timestamps();
        
        });
        DB::table('categories')->insert( array('categoryname' => 'PHP', 'description' => 'Most popular server-side programming language!' ) );                
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('categories');
    }
}
