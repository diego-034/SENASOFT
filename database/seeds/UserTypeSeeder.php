<?php

use Illuminate\Database\Seeder;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'Usuario';
        $user->email = 'usuer@senasoft.com';
        $user->password = bcrypt('12345678');
        $user->save();
    }
}
