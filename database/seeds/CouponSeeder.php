<?php

use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    use \App\Traits\Uuid;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('coupons')->insert([
            'uuid' => $this->getUuid(),
            'title' => 'FIXED10',
            'description' => 'Coupon FIXED10: Rules: cart total price must be greater than $50 before discounts, cart must contain at least 1 item. Discounts: $10 off total (fixed amount off)',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('coupons')->insert([
            'uuid' => $this->getUuid(),
            'title' => 'PERCENT10',
            'description' => 'Coupon PERCENT10: Rules: cart total price must be greater than $100 before discounts, cart must contain at least 2 item. Discounts: 10% off from cart total summ before discounts.',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('coupons')->insert([
            'uuid' => $this->getUuid(),
            'title' => 'MIXED10',
            'description' => 'Coupon MIXED10: Rules: cart total price must be greater than $200 before discounts, cart must contain at least 3 item. Discounts:  %10 or $10 (whichever is greatest).',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('coupons')->insert([
            'uuid' => $this->getUuid(),
            'title' => 'REJECTED10',
            'description' => 'Coupon MIXED10: Rules: cart total price must be greater than $1000 before discounts. Discounts: Both %10 and $10 should be applied.',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
