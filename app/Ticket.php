<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    public $timestamps = false;
	
    protected $guarded = [];

    public function location() {
        return $this->belongsTo(Location::class);
    }
}
