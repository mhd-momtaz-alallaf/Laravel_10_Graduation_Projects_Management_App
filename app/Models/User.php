<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded =[];
    /*protected $fillable = [
        'username',
        'name',
        'avatar',
        'email',
        'password',
    ];*/

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function setPasswordAttribute($value){
        $this->attributes['password'] = bcrypt($value);
    }

    public function setAvatarAttribute($value)
    {
        if(! str_contains($value,'https'))
            $this->attributes['avatar'] = asset("storage/".$value);
        else
            $this->attributes['avatar'] = $value ;
    }

    /*public function getAvatarAttribute($value)
   {
       if(! str_contains($value,'https'))
           return asset("storage/".$value);
       else
           return $value;
   }*/

    public function projects(){
        return $this->hasMany(Project::class);
    }

    public function permissions(){
        return $this->belongsToMany(Permission::class);
    }

    public function roles(){
        return $this->belongsToMany(Role::class);
    }



    public function userHasRole($role_name){
        foreach ($this->roles as $role){
            if (Str::lower($role_name) == Str::lower( $role->name))
                return true;
        }
        return false;
    }
}
