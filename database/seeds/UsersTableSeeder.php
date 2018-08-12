<?php
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UsersTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->truncate();

        User::create(
            [
                'name'			=>	'Proje',
                'email'			=>	'admin@proje.com',
                'password'		=>	Hash::make("password"),
                'role'			=>	1,
                'active'		=>	1,
            ]
        );
    }

}