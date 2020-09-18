<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $guarded = []; // Need to be fillable with only fields that can be inserted/updated, for more security reasons.

    public $timestamps = false;

    public function clientInfo(){
    	return $this->hasOne(ClientInfo::class);
    }

    public function clientDetail(){
    	return $this->hasOne(ClientDetail::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }
}
