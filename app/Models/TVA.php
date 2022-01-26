<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TVA extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'activity', 'address', 'city', 'country', 'phone', 'zip_code', 'user_id'];
}
