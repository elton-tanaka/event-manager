<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('rootadmin'),
        ]);

        DB::table('users')->insert([
            'name' => 'Elton Tanaka',
            'email' => 'elton@admin.com',
            'password' => bcrypt('rootadmin'),
        ]);

        DB::table('users')->insert([
            'name' => 'Roger',
            'email' => 'roger@roger.com',
            'password' => bcrypt('rootadmin'),
        ]);

        DB::table('events')->insert([
            'title' => 'Pawsome Playdate',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'date' => '2023-08-19 00:00:00',
            'city' => 'Marília',
            'promoted' => '0',
            'image' => 'event 1.jpg',
            'items' => '[
                "Chairs",
                "Open Bar",
                "Stage",
                "Gifts"
            ]',
            'user_id' => '1',
        ]);

        DB::table('events')->insert([
            'title' => 'Bark & Brews Bash: Dogs and Drinks Unite',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'date' => '2023-08-20 00:00:00',
            'city' => 'Marília',
            'promoted' => '0',
            'image' => 'event 2.jpg',
            'items' => '[
                "Chairs",
                "Open Bar",
                "Stage",
                "Gifts",
                "Smoking Area",
                "Vip Room"
            ]',
            'user_id' => '2',
        ]);

        DB::table('events')->insert([
            'title' => 'Doggy Disco Fever',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'date' => '2023-08-21 00:00:00',
            'city' => 'Tupã',
            'promoted' => '1',
            'image' => 'event 3.jpg',
            'items' => '[
                "Chairs",
                "Stage"
            ]',
            'user_id' => '3',
        ]);

        DB::table('events')->insert([
            'title' => 'Barking Book Club',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'date' => '2023-08-22 00:00:00',
            'city' => 'Marília',
            'promoted' => '1',
            'image' => 'event 4.jpg',
            'items' => '[
                "Gifts",
                "Smoking Area",
                "Vip Room"
            ]',
            'user_id' => '2',
        ]);

        DB::table('event_user')->insert([
            'event_id' => '1',
            'user_id' => '1'
        ]);

        DB::table('event_user')->insert([
            'event_id' => '1',
            'user_id' => '2'
        ]);

        DB::table('event_user')->insert([
            'event_id' => '1',
            'user_id' => '3'
        ]);

        DB::table('event_user')->insert([
            'event_id' => '2',
            'user_id' => '1'
        ]);

        DB::table('event_user')->insert([
            'event_id' => '2',
            'user_id' => '3'
        ]);

        DB::table('event_user')->insert([
            'event_id' => '3',
            'user_id' => '2'
        ]);
    }
}
