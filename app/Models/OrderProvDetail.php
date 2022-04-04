<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
use App\Helpers\Helper;

class OrderProvDetail extends Model
{
    protected $primaryKey = 'OrderId';
    protected $keyType = 'string';
    
    //public $timestamps = false;
    
    const CREATED_AT = 'OrderCreatedDt';
    const UPDATED_AT = 'LastUpdtDt';
}
