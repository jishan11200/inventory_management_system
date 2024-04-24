<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
     // The attributes that are mass assignable.
     protected $fillable = [
        'name', 'email', 'phone', 'address','nid_no', 'experience', 'photo', 'salary', 'vacation', 'city'
    ];

}
