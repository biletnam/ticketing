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
        $this->call(UserDatabaseSeeder::class);
        $this->call(TicketDatabaseSeeder::class);
        $this->call(AttendeeDatabaseSeeder::class);
    }
}
