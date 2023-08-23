<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $primaryKey='id';
    protected $table='brand';
    protected $fillable=['name','slug','status','img','parent_id','created_at','updated_at'];
}
