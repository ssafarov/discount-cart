<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Product extends Model
{
    use Uuid;

    //
    protected $table = 'products';

    protected $hidden = ['id'];

    protected $fillable = ['uuid', 'title','description', 'price'];

}
