<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    //
    use Uuid;

    protected $table = 'coupons';

    protected $guarded = ['id'];

    protected $fillable = ['uuid', 'title'];

    /**
     * Each coupon can have several rules
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rules () {
        return $this->hasMany(Rule::class);
    }

}
