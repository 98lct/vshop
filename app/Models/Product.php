<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey='id';
    protected $table='product';
    protected $fillable=[
    	'name','slug','status','img','category_id','brand_id','created_at','updated_at',
    	'detail','describe','camera_info','connect','utilities','other_information','gpu','screen',
    	'resolution','chipset','design','material','size','weight','operating','rom','rom_available',
    	'number','price','pricesale','ram','battery','camera_primary','camera',
	];
	public function category()
    {
        return $this->belongsTo('App\Models\Category','category_id','id');
        //quan hệ 1-1 belongsTo tức là 1 product chỉ có 1 mã category thôi tham số thứ 1 là model mà nó quan hệ(category), tham số thứ 2 là khóa ngoại của model chính(ở đây là khóa ngoại category_id trong bảng product), tham số thứ 3 là khóa chính của model nó quan hệ(id của bảng category) , hasmany nó sẽ ngượt lại vs belongsto ở tham số thứ 2 và 3
    }
    public function brand()
    {
        return $this->belongsTo('App\Models\Brand','brand_id','id');
    }
}
