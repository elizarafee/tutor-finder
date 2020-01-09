<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institute extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'institutes';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
}
