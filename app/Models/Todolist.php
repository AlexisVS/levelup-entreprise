<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todolist extends Model
{
    use HasFactory;

    protected $fillable = ['user_id'];

    public function todos()
    {
        return $this->hasMany(Todo::class);
    }
}
