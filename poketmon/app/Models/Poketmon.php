<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poketmon extends Model
{
    use HasFactory;

    protected $table = "poketmons";
    protected $fillable = [
        "num",
        "name",
        "weakness",
        "weight",
        "height",
        "img",
        "type_num1",
        "type_num2",
        "next_evolution",
        "created_at",
        "updated_at",
    ];

    public $incrementing = true;

    public function type() {
        return $this->belongsTo('App\Models\Type');
    }

    public function evolution() {
        return $this->hasMany('App\Models\Evolution');
    }
}
