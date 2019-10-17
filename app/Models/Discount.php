<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $table = 'discounts';

    protected $hidden = ['id','coupon_id'];
    protected $guarded = ['id'];

    protected $fillable = [
        'type', 'condition', 'value'
    ];

    public function coupon() {
        return $this->belongsTo(Coupon::class);
    }
}
