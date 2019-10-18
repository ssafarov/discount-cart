<?php

use Illuminate\Database\Seeder;

class RulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rules')->insert([
            'coupon_id' => 1,
            'type' => 'single',
            'trigger' => 'amount',
            'triggerCondition' => 'greaterEq',
            'triggerValue' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('rules')->insert([
            'coupon_id' => 1,
            'type' => 'and',
            'trigger' => 'total',
            'triggerCondition' => 'greater',
            'triggerValue' => '50',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('rules')->insert([
            'coupon_id' => 2,
            'type' => 'single',
            'trigger' => 'amount',
            'triggerCondition' => 'greaterEq',
            'triggerValue' => '2',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('rules')->insert([
            'coupon_id' => 2,
            'type' => 'and',
            'trigger' => 'total',
            'triggerCondition' => 'greater',
            'triggerValue' => '100',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('rules')->insert([
            'coupon_id' => 3,
            'type' => 'single',
            'trigger' => 'amount',
            'triggerCondition' => 'greaterEq',
            'triggerValue' => '3',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('rules')->insert([
            'coupon_id' => 3,
            'type' => 'and',
            'trigger' => 'total',
            'triggerCondition' => 'greater',
            'triggerValue' => '200',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('rules')->insert([
            'coupon_id' => 4,
            'type' => 'single',
            'trigger' => 'total',
            'triggerCondition' => 'greater',
            'triggerValue' => '1000',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
