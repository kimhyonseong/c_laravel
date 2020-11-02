<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    //public $timestamps = false;

    //데이터 삽입을 허락할 칼럼 명시
    protected $fillable = ['title','body'];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
