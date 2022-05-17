<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('users')->insert(
            array(
                'nickname' => 'J',
                'password' => Hash::make('12345678'),
                'firstname' => 'J',
                'lastname' => 'GA',
                'email' => 'i82gaarj@uco.es',
                'phone' => 333,
                'type' => 'Admin'
            )
        );

        DB::table('users')->insert(
            array(
                'nickname' => 'JA',
                'password' => Hash::make('12345678'),
                'firstname' => 'r',
                'lastname' => 'GA',
                'email' => 'i82gaarrj@uco.es',
                'phone' => 333,
                'type' => 'User'
            )
        );

        /*DB::table('pieces')->insert(
            array(
                'title' => 'hola',
                'author' => 'Mozart',
                'user_id' => 1,
                'year' => 2022,
                'duration' => 100,
                'type' => 'requiem',
                'file_name' => 'asad.pdf'
            )
        );*/

        DB::table ('instruments')->insert(
            [
                ['name'=>'Violonchelo'],
                ['name'=>'Piano'],
                ['name'=>'Violín']                
                //...
            ]
        );

        /*DB::table('pieces_instruments')->insert(
            array(
                'piece_id' => 1,
                'instrument_id' => 1
            )
        );*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
