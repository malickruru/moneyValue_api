<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pairs extends Model
{
    use HasFactory;

    protected $table = 'pairs';

    protected $fillable = [
        'from',
        'to',
        'change_rate',
        'created_at'
    ];

    
    public function total(){
        return $this->hasMany(Conversion::class,'pair_id','id')->get()->count();
    }
}
