<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model{
    
    protected $fillable = ['base','altura','area','tipo'];
    protected $table = 'areas';
}
