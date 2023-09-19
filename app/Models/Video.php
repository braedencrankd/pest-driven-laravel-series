<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Video extends Model
{
    use HasFactory;


    public function getReadableDuration()
    {
        return Str::of($this->duration_in_mins)->append('min');
    }
}
