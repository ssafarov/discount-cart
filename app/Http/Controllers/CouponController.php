<?php

    namespace App\Http\Controllers;

    use App\Http\Requests\CouponRequest;
    use App\Models\Coupon;
    use App\Models\Discount;
    use App\Models\Rule;
    use Illuminate\Support\Facades\DB;
    use Mockery\Exception;

    class CouponController extends Controller
    {
        //
        public function index()
        {
            $coupons = Coupon::with('rules')->latest()->get();
            return view('coupons.list', compact('coupons'));
        }

        public function create(CouponRequest $request)
        {
            return view('coupons.create');
        }

        public function store(CouponRequest $request)
        {
            $request->validate([
                'title'=>'required',
                'rules'=>'array',
                'discount'=>'array'
            ]);

            $done = true;
            $rules = $request['rules'];
            $discounts = $request['discount'];

            DB::beginTransaction();
            try {
                $coupon = new Coupon;
                $coupon->title = $request['title'];

                if ($coupon->save()) {
                    foreach ($rules as $item) {
                        if (!empty($item['triggerValue']) && !empty($item['discountValue'])){
                            $rule = Rule::Create($item);
                            $rule->coupon()->associate($coupon->id);
                            $done = $done && $rule->save();
                        }
                    }
                    foreach ($discounts as $item) {
                        if (!empty($item['value'])){
                            $discount = Discount::Create($item);
                            $discount->coupon()->associate($coupon->id);
                            $done = $done && $discount->save();
                        }
                    }
                }
            } catch (Exception $e){
                $done = false;
            }

            if ($done) {
                DB::commit();
                return redirect('coupons')->with('success', 'Coupon was added!');
            }

            DB::rollback();
            return redirect('coupons')->with('error', 'Coupon was not added!!!');
        }

        public function show($uuid)
        {
            $coupon = Coupon::where('uuid', $uuid)->firstOrFail()->toArray();

            return response()->json($coupon);
        }


        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $uuid
         * @return \Illuminate\Http\Response
         */
        public function edit($uuid)
        {
            $coupon = Coupon::where('uuid', $uuid)->firstOrFail();
            return view('coupons.edit', compact('coupon'));
        }


        public function update(CouponRequest $request, $uuid)
        {
            $coupon = Coupon::where('uuid', $uuid)->firstOrFail();
            $coupon->update($request->all());

            return redirect('/coupons')->with('success', 'Coupon updated!');
        }

        public function destroy($uuid)
        {
            $coupon = Coupon::where('uuid', $uuid);
            $coupon->delete();
            return redirect('/coupons')->with('success', 'Coupon deleted!');
        }

    }
