<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        DB::table('users')->insert([
                'name' => 'alex',
                'email' => 'alex@hublagram.in',
                'password' => '$2y$10$riPOobLnGHIR6eT4E1kGROjsyqdOVoDX8yYEJSso3W7oy5.OXtn/y',
            ]);
    }
}
