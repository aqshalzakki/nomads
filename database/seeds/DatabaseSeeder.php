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
        factory(\App\TravelPackage::class, 25)->create();
        $this->call(TransactionStatusesTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
    }
}
