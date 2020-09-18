<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    public $timestamps = false;
	
    protected $guarded = [];

    public function tickets() {
        return $this->hasMany(Ticket::class);
    }

    public function entries() {
        return $this->hasMany(Entries::class);
    }
}
