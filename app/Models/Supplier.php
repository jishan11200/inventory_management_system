<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suppliers extends Model
{
    
    protected $fillable = [
        'name', 'email', 'phone', 'address','type', 'photo','shop', 'accountholder', 'accountnumber', 'bankname','bankbranch', 'city'
    ];
    use HasFactory;
}
