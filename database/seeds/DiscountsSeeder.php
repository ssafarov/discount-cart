<?php

use Illuminate\Database\Seeder;

class DiscountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('discounts')->insert([
            'coupon_id' => 1,
            'type' => 'amount',
            'condition' => 'basic',
            'value' => '10',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('discounts')->insert([
            'coupon_id' => 2,
            'type' => 'percent',
            'condition' => 'basic',
            'value' => '10',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('discounts')->insert([
            'coupon_id' => 3,
            'type' => 'amount',
            'condition' => 'basic',
            'value' => '10',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('discounts')->insert([
            'coupon_id' => 3,
            'type' => 'percent',
            'condition' => 'greater',
            'value' => '10',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('discounts')->insert([
            'coupon_id' => 4,
            'type' => 'amount',
            'condition' => 'basic',
            'value' => '10',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('discounts')->insert([
            'coupon_id' => 4,
            'type' => 'percent',
            'condition' => 'extra',
            'value' => '10',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
