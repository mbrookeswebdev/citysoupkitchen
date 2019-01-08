<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run ()
    {
        $user = new \App\User(['id' => 1,
            'name' => 'John Doe',
            'email' => 'jd@johndoetest.com',
            'password' => '123',
            'remember_token' => 234]);
        $user->save();

        $user = new \App\User(['id' => 2,
            'name' => 'Jack Doe',
            'email' => 'jackdoe@jackdoetest.com',
            'password' => '123',
            'remember_token' => 123]);
        $user->save();

        $user = new \App\User(['id' => 3,
            'name' => 'Ellie Doe',
            'email' => 'elliedoe@elliedtest.com',
            'password' => '789',
            'remember_token' => 345]);
        $user->save();
    }
}
