<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('authorname');
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('zip');
            $table->string('email_id');
            $table->string('phone');
            $table->timestamps();
        });

        // Insert some stuff
        DB::table('authors')->insert(
            array(
                'authorname' => 'Kavi Lakshmi',
                'address' => '1 Washington Blvd',
                'city' => 'Chennai',
                'state' => 'TN',
                'zip' => '123456',
                'email_id' => 'kl@example.com',
                'phone' => '123456'
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
        Schema::drop('authors');
    }
}
