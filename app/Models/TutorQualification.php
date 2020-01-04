<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TutorQualification extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tutor_qualifications';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
}
