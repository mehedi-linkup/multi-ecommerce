<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function division(){
        return $this->belongsTo(Division::class, 'division_id');
    }
    
    public function district(){
        return $this->belongsTo(District::class, 'district_id');
    }
    
    public function state(){
        return $this->belongsTo(State::class, 'state_id');
    }
    
}
