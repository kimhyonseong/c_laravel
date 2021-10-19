<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poketmon extends Model
{
    use HasFactory;

    protected $table = "poketmons";
    protected $fillable = [ "num", "name", "weakness", "weight", "height", "img", "type_num1", "type_num2", "next_evolution"];

    public $incrementing = true;

}
