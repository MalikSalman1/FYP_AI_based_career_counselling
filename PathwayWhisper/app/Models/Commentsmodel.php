<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentsmodel extends Model
{
    protected $table = 'comments';
    protected $fillable = ['body'];

    use HasFactory;
}
