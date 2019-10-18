<?php

use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Default cart uuid for testing: 39e7062f-fa31-480a-aaf1-a534e2541381
        // Should use this uuid in the frontend app

        DB::table('cart')->insert([
            'uuid' => '39e7062f-fa31-480a-aaf1-a534e2541381',
            'created_at' => now(),
            'updated_at' => now()
        ]);

    }
}
