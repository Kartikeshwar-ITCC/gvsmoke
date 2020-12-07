<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AgencyJobs extends Model
{
    use SoftDeletes;
    protected $dates = ['last_alarm_service',  'last_gas_service',  'last_elec_service'];

    public function agency()
    {
        return $this->belongsTo('App\User')->withTrashed();
    }
    public function clonedJob(){
        return $this->hasOne('App\AgencyJobChanges','job_id','id');
    }
    public function invoices()
    {
        return $this->hasMany('App\Invoice','job_id','id')->latest();
    }

    public function setServiceMonthAttribute($value)
    {
        if($value == 'January'){
            $this->attributes['service_month'] = 'January';
            $this->attributes['service_month_int'] = '01';
        } else if($value == 'February'){
            $this->attributes['service_month'] = 'February';
            $this->attributes['service_month_int'] = '02';
        } else if($value == 'March'){
            $this->attributes['service_month'] = 'March';
            $this->attributes['service_month_int'] = '03';
        } else if($value == 'April'){
            $this->attributes['service_month'] = 'April';
            $this->attributes['service_month_int'] = '04';
        } else if($value == 'May'){
            $this->attributes['service_month'] = 'May';
            $this->attributes['service_month_int'] = '05';
        } else if($value == 'June'){
            $this->attributes['service_month'] = 'June';
            $this->attributes['service_month_int'] = '06';
        } else if($value == 'July'){
            $this->attributes['service_month'] = 'July';
            $this->attributes['service_month_int'] = '07';
        } else if($value == 'August'){
            $this->attributes['service_month'] = 'August';
            $this->attributes['service_month_int'] = '08';
        } else if($value == 'September'){
            $this->attributes['service_month'] = 'September';
            $this->attributes['service_month_int'] = '09';
        } else if($value == 'October'){
            $this->attributes['service_month'] = 'October';
            $this->attributes['service_month_int'] = '10';
        } else if($value == 'November'){
            $this->attributes['service_month'] = 'November';
            $this->attributes['service_month_int'] = '11';
        } else if($value == 'December'){
            $this->attributes['service_month'] = 'December';
            $this->attributes['service_month_int'] = '12';
        } else if($value == 'NA'){
            $this->attributes['service_month'] = 'NA';
            $this->attributes['service_month_int'] = '13';
        }
    }

    // public function setServiceMonth1Attribute($value)
    // {
    //     if($value == 'January'){
    //         $this->attributes['service_month_1'] = 'January';
    //         $this->attributes['service_month_int_1'] = '01';
    //     } else if($value == 'February'){
    //         $this->attributes['service_month_1'] = 'February';
    //         $this->attributes['service_month_int_1'] = '02';
    //     } else if($value == 'March'){
    //         $this->attributes['service_month_1'] = 'March';
    //         $this->attributes['service_month_int_1'] = '03';
    //     } else if($value == 'April'){
    //         $this->attributes['service_month_1'] = 'April';
    //         $this->attributes['service_month_int_1'] = '04';
    //     } else if($value == 'May'){
    //         $this->attributes['service_month_1'] = 'May';
    //         $this->attributes['service_month_int_1'] = '05';
    //     } else if($value == 'June'){
    //         $this->attributes['service_month_1'] = 'June';
    //         $this->attributes['service_month_int_1'] = '06';
    //     } else if($value == 'July'){
    //         $this->attributes['service_month_1'] = 'July';
    //         $this->attributes['service_month_int_1'] = '07';
    //     } else if($value == 'August'){
    //         $this->attributes['service_month_1'] = 'August';
    //         $this->attributes['service_month_int_1'] = '08';
    //     } else if($value == 'September'){
    //         $this->attributes['service_month_1'] = 'September';
    //         $this->attributes['service_month_int_1'] = '09';
    //     } else if($value == 'October'){
    //         $this->attributes['service_month_1'] = 'October';
    //         $this->attributes['service_month_int_1'] = '10';
    //     } else if($value == 'November'){
    //         $this->attributes['service_month_1'] = 'November';
    //         $this->attributes['service_month_int_1'] = '11';
    //     } else if($value == 'December'){
    //         $this->attributes['service_month_1'] = 'December';
    //         $this->attributes['service_month_int_1'] = '12';
    //     } else if($value == 'NA'){
    //         $this->attributes['service_month_1'] = 'NA';
    //         $this->attributes['service_month_int_1'] = '13';
    //     }
    // }

    // public function setServiceMonth2Attribute($value)
    // {
    //     if($value == 'January'){
    //         $this->attributes['service_month_2'] = 'January';
    //         $this->attributes['service_month_int_2'] = '01';
    //     } else if($value == 'February'){
    //         $this->attributes['service_month_2'] = 'February';
    //         $this->attributes['service_month_int_2'] = '02';
    //     } else if($value == 'March'){
    //         $this->attributes['service_month_2'] = 'March';
    //         $this->attributes['service_month_int_2'] = '03';
    //     } else if($value == 'April'){
    //         $this->attributes['service_month_2'] = 'April';
    //         $this->attributes['service_month_int_2'] = '04';
    //     } else if($value == 'May'){
    //         $this->attributes['service_month_2'] = 'May';
    //         $this->attributes['service_month_int_2'] = '05';
    //     } else if($value == 'June'){
    //         $this->attributes['service_month_2'] = 'June';
    //         $this->attributes['service_month_int_2'] = '06';
    //     } else if($value == 'July'){
    //         $this->attributes['service_month_2'] = 'July';
    //         $this->attributes['service_month_int_2'] = '07';
    //     } else if($value == 'August'){
    //         $this->attributes['service_month_2'] = 'August';
    //         $this->attributes['service_month_int_2'] = '08';
    //     } else if($value == 'September'){
    //         $this->attributes['service_month_2'] = 'September';
    //         $this->attributes['service_month_int_2'] = '09';
    //     } else if($value == 'October'){
    //         $this->attributes['service_month_2'] = 'October';
    //         $this->attributes['service_month_int_2'] = '10';
    //     } else if($value == 'November'){
    //         $this->attributes['service_month_2'] = 'November';
    //         $this->attributes['service_month_int_2'] = '11';
    //     } else if($value == 'December'){
    //         $this->attributes['service_month_2'] = 'December';
    //         $this->attributes['service_month_int_2'] = '12';
    //     } else if($value == 'NA'){
    //         $this->attributes['service_month_2'] = 'NA';
    //         $this->attributes['service_month_int_2'] = '13';
    //     }
    // }
}
