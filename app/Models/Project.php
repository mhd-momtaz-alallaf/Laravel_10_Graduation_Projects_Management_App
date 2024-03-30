<?php

namespace App\Models;

use http\Client\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $guarded =[];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function setProjectImageAttribute($value)
    {
        if(! str_contains($value,'https'))
            $this->attributes['project_image'] = asset("storage/".$value);
        else
            $this->attributes['project_image'] = $value ;
    }

    /*public function getProjectImageAttribute($value)
    {
        if(! str_contains($value,'https'))
            return asset("storage/".$value);
        else
            return $value;
    }*/


}
