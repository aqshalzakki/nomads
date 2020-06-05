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
        $this->call([
            TransactionStatusesTableSeeder::class,
            RoleTableSeeder::class,
            CategoriesTableSeeder::class
        ]);
        
        factory(\App\TravelPackage::class, 5)->create();
        factory('App\User', 5)->create();
    }
}
