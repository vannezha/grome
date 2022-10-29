<?php

namespace Database\Seeders;

use App\Models\Grometool;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)
            ->create()
            ->each(function ($u) {
                Grometool::factory(3)
                    ->create(['username'=>$u->username]);
            });
        $this->call([
            DashboardTableSeeder::class,
        ]);
    }
}
