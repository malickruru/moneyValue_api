<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversion extends Model
{
    use HasFactory;

    protected $table = 'conversion';

    protected $fillable = [
        'pair_id',
        'amount',
        'created_at'
    ];

    function pair()  {
        return $this->hasOne(Pairs::class,'id','pair_id');
    }

    
}
