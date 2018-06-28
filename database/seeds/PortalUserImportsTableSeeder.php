<?php

use Illuminate\Database\Seeder;

class PortalUserImportsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('portal_user_imports')->delete();
        
        \DB::table('portal_user_imports')->insert(array (
            0 => 
            array (
                'id' => 1,
                'portal_id' => 0,
                'created_at' => '2014-11-05 10:47:32',
                'updated_at' => '2015-10-26 08:23:54',
            ),
        ));
        
        
    }
}
