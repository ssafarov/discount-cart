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
        //Product list. Not used in final
        $this->call(ProductsListSeeder::class);

        //Coupons
        $this->call(CouponSeeder::class);
        $this->call(DiscountsSeeder::class);
        $this->call(RulesSeeder::class);

    }
}
