<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    //
    public function waiter() {
        return $this->belongsTo('App\User');
    }
    public function orders(){
        return $this->hasMany('App\Order');
    }
}
