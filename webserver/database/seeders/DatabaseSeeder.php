<?php

namespace Database\Seeders;

use App\Models\Grometool;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)
        //     ->create()
        //     ->each(function ($u) {
        //         Grometool::factory(3)
        //             ->create(['username'=>$u->username]);
        //     });
                // ['username'=>'vannyezha',
                // 'name' => 'Vanny Ezha`an Nur Sandika',
                // 'email' => 'vannyezhaa@gmail.com',
                // 'password' => 'password'],

                // ['username'=>'aqilaqil',
                // 'name' => 'Aqil Solo',
                // 'email' => 'aqilaqil@gmail.com',
                // 'password' => 'password'],

                // ['username'=>'donidoni',
                // 'name' => 'Doni Doni',
                // 'email' => 'donidoni@gmail.com',
                // 'password' => 'password'],
        User::factory()
            ->create([
                'username'=>'vannyezha',
                'name' => 'Vanny Ezha`an Nur Sandika',
                'email' => 'vannyezhaa@gmail.com',
                'password' => Hash::make('password'),
            ])
            ->each(function($u){
                Grometool::factory()
                    ->create([
                        'username'=>$u->username,
                        'name' => 'Grome ver1',
                        'guid' => 'grome800000001',
                        // 'variable' => 'test',
                        // 'se'
                    ]);
            });
        $this->call([
            DashboardTableSeeder::class,
        ]);
    }
}
