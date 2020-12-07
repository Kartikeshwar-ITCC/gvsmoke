<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public function job()
    {
        return $this->belongsTo('App\AgencyJobs');
    }
}
