<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table="post";
    public function topic()
    {
        return $this->belongsTo('App\Models\Topic','topic_id','id');
        //quan hệ 1-1 belongsTo tức là 1 product chỉ có 1 mã category thôi tham số thứ 1 là model mà nó quan hệ(category), tham số thứ 2 là khóa ngoại của model chính(ở đây là khóa ngoại category_id trong bảng product), tham số thứ 3 là khóa chính của model nó quan hệ(id của bảng category) , hasmany nó sẽ ngượt lại vs belongsto ở tham số thứ 2 và 3
    }
}
