<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            [
                'name' => 'Falabella',
                'address' => 'Crr Test # Test -Test',
                'document' => '3016850462',
                'phone' => '3016850462'
            ],
            [
                'name' => 'Exito',
                'address' => 'Crr Test # Test -Test',
                'document' => '3016850462',
                'phone' => '3016850462'
            ],
            [
                'name' => 'Flamingo',
                'address' => 'Crr Test # Test -Test',
                'document' => '3016850462',
                'phone' => '3016850462'
            ]
        );
        DB::table('stores')->insert($data);
    }
}
