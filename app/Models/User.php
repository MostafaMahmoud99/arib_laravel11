<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'manager_id',
        'department_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'salary',
        'password',
    ];

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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function media(){
        return $this->morphOne(Media::class,"mediable");
    }

    public function Manager(){
        return $this->belongsTo(Manager::class,"manager_id","id");
    }


    public function Department(){
        return $this->belongsTo(Department::class,"department_id","id");
    }

    public function Tasks(){
        return $this->hasMany(Task::class,"user_id","id");
    }
}
