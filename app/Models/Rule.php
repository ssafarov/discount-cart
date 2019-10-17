<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Rule extends Model
    {
        //
        protected $table = 'rules';

        protected $hidden = ['id','coupon_id'];
        protected $guarded = ['id'];

        protected $fillable = [
            'type', 'condition', 'trigger', 'triggerCondition', 'triggerValue', 'discount', 'discountValue'
        ];

        public function coupon() {
            return $this->belongsTo(Coupon::class);
        }

    }
