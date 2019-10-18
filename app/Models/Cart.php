<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //
    protected $table = 'cart';

    protected $hidden = ['id'];
    protected $guarded = ['id'];

    protected $fillable = ['uuid', 'originalTotal', 'reducedTotal'];

    public function coupon(){
        return $this->belongsTo(Coupon::class);
    }

}
