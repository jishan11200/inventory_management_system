<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advance_salary extends Model
{
    protected $fillable = [
        'emp_id','month','year','status','advance_salary',
    ];
    use HasFactory;
}
