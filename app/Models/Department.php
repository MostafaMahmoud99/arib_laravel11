<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "description"
    ];

    protected $hidden = [
        "created_at",
        "updated_at"
    ];

    public function Users(){
        return $this->hasMany(User::class,"department_id","id");
    }
}
