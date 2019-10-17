<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Discount;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;



class ShoppingCartController extends Controller
{

    /**
     * This was created instead of simple eval() to keep all calculations safe and under controll.
     *
     * @param mixed $a First comparable value
     * @param mixed $b Second comparable value
     * @param string $condition Logical condition which should be executed written be string
     *
     * @return bool
     */
    private function _safeLogicEvaluation ($a, $b, $condition)
    {
        switch($condition) {
            case 'equal': return $a == $b;
            case 'greater': return $a > $b;
            case 'less': return $a < $b;
            case 'greaterEq': return $a >= $b;
            case 'lessEq': return $a <= $b;
        }
    }

    /**
     * Check if rule trigger applicable to current cart state
     *
     * @param $cartAmt
     * @param $cartTotal
     * @param $rule
     * @return bool
     */
    private function _checkTriggerApplicable ($cartAmt, $cartTotal, $rule)
    {
        $compareWhat = $rule->trigger === 'count'? $cartAmt : $cartTotal;
        return $this->_safeLogicEvaluation($compareWhat, $rule->triggerValue, $rule->triggerCondition);
    }

    /**
     * Apply the rule discount to cart amount
     *
     * @param mixed $total
     * @param Discount $discount The discount object
     * @return bool|float New (adjusted) cart amount
     */
    private function _calculateDiscountAmount($total, $discount)
    {
        if (!is_numeric($total)){
            return false;
        }

        $amount = $discount->value;

        if ($discount->type === 'percent') {
            $amount = $total * $discount->value / 100;
        }

        return $amount > 0? $amount:0;
    }

    //
    public function CalculateDiscount (Request $request)
    {
        $cartAmount = $request['amount'];
        $cartTotal = $request['total'];
        $cartCoupon = $request['coupon'];
        $currentTotal = $cartTotal;
        $canBeApplied = [];
        $discounts = [];
        $discount = 0;

        try {
            $coupon = Coupon::with(['rules','discounts'])->where('title', $cartCoupon)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return response(json_encode('Coupon not found'), 400);
        }

        // Step 0. Basic checks
        $done = count($coupon->rules) && count($coupon->discounts);

        // Step 1. Get & check basic rule trigger condition
        foreach ($coupon->rules as $item) {
            $canBeApplied[$item->type] = $item;
        }
        foreach ($coupon->discounts as $item) {
            $discounts[$item->condition] = $item;
        }


        $done = $done && array_key_exists('single', $canBeApplied) && array_key_exists('basic', $discounts);

        if (!$done) {
            return response(json_encode('Coupon is not valid'), 400);
        }

        $basicRule = $canBeApplied['single'];
        $basicDiscount = $discounts['basic'];
        unset($discounts['basic']);
        unset($canBeApplied['single']);
        //Step 2. Check if basic rule applicable
        $applicable = $this->_checkTriggerApplicable($cartAmount, $cartTotal, $basicRule);


        //Step 3. Walk throught the rest of rules to find AND, OR rules
        foreach ($canBeApplied as $rule) {
            // Step 3.1. Check rule trigger condition
            if ($rule->type === 'and') {
                $applicable = $applicable && $this->_checkTriggerApplicable($cartAmount, $cartTotal, $rule);
            } else {
                $applicable = $this->_checkTriggerApplicable($cartAmount, $cartTotal, $rule);
            }
        }

        // Step 4. Still applicable  - so lets calculate discount amount
        if ($applicable) {
            //Walk throught the discounts set
            $discount = $this->_calculateDiscountAmount($cartTotal, $basicDiscount);
            foreach ($discounts as $item) {
                $discountItem = $this->_calculateDiscountAmount($cartTotal, $item);
                switch ($item->condition) {
                    case 'greater':
                        $discount = $discountItem > $discount? $discountItem : $discount;
                    break;
                    case 'extra':
                        $discount = $discount + $discountItem;
                        break;
                }
            }
            $currentTotal = $cartTotal - $discount;
            return response(json_encode($currentTotal), 200);
        }



        return response(json_encode('Coupon not applicable'), 400);

    }


}
