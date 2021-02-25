<?php

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
//        $this->call(UsersTableSeeder::class);
//        $this->call(ArticlesTableSeeder::class);
//        $this->call(LikesTableSeeder::class);
//        $this->call(FollowsTableSeeder::class);
//        $this->call(CommentsTableSeeder::class);
        \App\Models\User::create([
            'name' => 'Nguyen Thuong',
            'email' => 'thuongne123@gmail.com',
            'password' => Hash::make(123123123),
            'profile_image' => '',
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
