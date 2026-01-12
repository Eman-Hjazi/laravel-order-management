<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            ['name'=>'Alice','email'=>'alice@example.com','password'=>Hash::make('123456'),'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Bob','email'=>'bob@example.com','password'=>Hash::make('123456'),'created_at'=>now(),'updated_at'=>now()],
        ]);
    }
}
