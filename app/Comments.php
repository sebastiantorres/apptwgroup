<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    //
    //
    protected $fillable = [
        'content','publication_id','user_id','status'
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function publication()
    {
        return $this->belongsTo('App\Publications');
    }

}
