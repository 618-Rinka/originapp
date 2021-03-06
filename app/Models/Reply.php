<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = ['body'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function topic()
    {
        return $this->belongsTo(Reply::class);
    }
    
    public function likingUsers()
    {
        return $this->belongsToMany(User::class,'likes')->withPivot('count');
    }

}
