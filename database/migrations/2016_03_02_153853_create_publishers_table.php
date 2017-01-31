<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublishersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publishers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('publishername');
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('zip');
            $table->string('email_id');
            $table->string('phone');
            $table->timestamps();
        });
        DB::table('publishers')->insert(
            array(
                'publishername' => 'APress',
                'address' => '1 Main Street',
                'city' => 'Chennai',
                'state' => 'TN',
                'zip' => '123456',
                'email_id' => 'apress@example.com',
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
        Schema::drop('publishers');
    }
}
