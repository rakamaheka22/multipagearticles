<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();

        factory(User::class)->create([
            'name' => 'Arya Mahardika',
            'email' => 'arya@rollingglory.com',
            'password' => Hash::make('secret'),
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
