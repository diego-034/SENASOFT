<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            ['type'=>'admin'],['type'=>'manager'],['type'=>'customer']
        );
        DB::table('user_types')->insert($data);
    }
}
