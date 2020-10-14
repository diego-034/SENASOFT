<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchSeeder extends Seeder
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
                'name' => 'Falabella norte',
                'address' => 'Crr Test # Test -Test',
                'store_id' => '1',
                'phone' => '3016850462'
            ],
            [
                'name' => 'Falabella sur',
                'address' => 'Crr Test # Test -Test',
                'store_id' => '1',
                'phone' => '3016850462'
            ],
            [
                'name' => 'Exito norte',
                'address' => 'Crr Test # Test -Test',
                'store_id' => '2',
                'phone' => '3016850462'
            ]
        );
        DB::table('branches')->insert($data);
    }
}
