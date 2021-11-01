<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evolution extends Model
{
    use HasFactory;

    protected $table = 'evolutions';
    protected $fillable = [
        'num',
        'group_num',
        'name',
        'img',
        "created_at",
        "updated_at",
    ];

    public function poketmon() {
        return $this->belongsTo('App\Models\Poketmon');
    }
}
