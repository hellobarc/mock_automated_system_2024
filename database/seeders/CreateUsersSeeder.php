<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $users = [
            [
               'name'=>'Admin User',
               'email'=>'admin@barc.com',
               'type'=>6,
               'password'=> bcrypt('123456'),
            ],
            [
               'name'=>'Register',
               'email'=>'register@barc.com',
               'type'=> 0,
               'password'=> bcrypt('123456'),
            ],
            [
               'name'=>'assessor',
               'email'=>'assessor@barc.com',
               'type'=>1,
               'password'=> bcrypt('123456'),
            ],
            [
               'name'=>'moderator',
               'email'=>'moderator@barc.com',
               'type'=>2,
               'password'=> bcrypt('123456'),
            ],
            [
               'name'=>'editor',
               'email'=>'editor@barc.com',
               'type'=>3,
               'password'=> bcrypt('123456'),
            ],
            [
               'name'=>'accounts',
               'email'=>'accounts@barc.com',
               'type'=>4,
               'password'=> bcrypt('123456'),
            ],
            [
               'name'=>'invigilator',
               'email'=>'invigilator@barc.com',
               'type'=>5,
               'password'=> bcrypt('123456'),
            ],
        ];
    
        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
