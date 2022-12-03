<?php

namespace Database\Seeders;
use App\Models\User;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Steven Ulloa Gutierrez',
            'email' => 'ulloadeifheltsteven@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('ulloadeifheltsteven@gmail.com'), // password
            'identity_card' =>'161-210501-1000K',
            'address' =>'del panteoncito el carmen 3c al sur y c3 al oeste',
            'phone' => '+505 57196244',
            'role' =>'admin',
        ]);

        User::factory()
        ->count(50)
        ->create();
    }
}
