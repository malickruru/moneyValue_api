<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currencies extends Model
{
    use HasFactory;

    protected $table = 'currencies';
    public $timestamps = false;

    protected $primaryKey = 'code';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'code',
        'name',
        'flag',
        'symbol'
    ];

    public function pair(){
        return $this->belongsToMany($this,'pairs','from','to');
    }
}
