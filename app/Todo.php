<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['userId','title','completed'];

    protected $with = ['user'];

    /**
     * relationships
    */
    public function user() {
        return $this->belongsTo(User::class,'userId');
    }
}
