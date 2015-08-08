<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Job_schedule extends Model {

    public $timestamps = false;

    protected $guarded = array();

    protected $table = 'job_schedule';

}
