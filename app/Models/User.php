<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
   protected $table="user";
   protected $primaryKey="id";
   protected $fillable=['name','email','img','roles','password','created_at','updated_at'];

}
