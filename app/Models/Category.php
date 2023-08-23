<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
   	protected $primaryKey='id';
    protected $table='category';
    protected $fillable=['name','slug','status','img','parent_id','created_at','updated_at'];
}
