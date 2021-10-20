<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $table = 'types';

    protected $fillable = [
        'type_num',
        'type_name',
        'created_at',
        'updated_at'
    ];

    public function poketmons() {
        return $this->hasMany('App\Models\Poketmon');
    }
}
