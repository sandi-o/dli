<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * relationships
    */
    public function tasks() {
        return $this->hasMany(Task::class);
    }

    /**
     * methods
     */

    public function addTask($data) {
        return $this->tasks()->create($data);
    }
}
