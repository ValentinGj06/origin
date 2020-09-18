<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientInfo extends Model
{
    protected $table = 'client_info';
    protected $primaryKey = 'client_id';

    public $timestamps = false;

    public function client(){
    	return $this->belongsTo(Client::class);
    }
}
