<?php

use Illuminate\Database\Seeder;

class PasswordResetsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('password_resets')->delete();
        
        \DB::table('password_resets')->insert(array (
            0 => 
            array (
                'email' => 'phil.yeomans@totalpeople.co.uk',
                'token' => 'c13708bfb0ba6bb7e7b535b15f4c8330720869b665cdbf70024ed59fb3412f43',
                'created_at' => '2016-01-19 13:34:23',
            ),
        ));
        
        
    }
}
