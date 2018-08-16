<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $fillable = [
    'name', 'terminal_id', 'token','user_name','password','stat',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function peyment()
    {
        return $this->hasOne(Payment::class);
    }
}
