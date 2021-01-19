<?php

namespace Zareismail\NovaCurrency\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class NovaCurrency extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Query the enabled currencies.
     * 
     * @param  \Illuminate\Database\Eloqeunt\Query $query 
     * @return \Illuminate\Database\Eloqeunt\Query        
     */
    public function scopeEnabled($query)
    {
    	return $query->whereEnabled(1);
    }
}
