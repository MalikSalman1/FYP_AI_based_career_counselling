<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LivestreamsModel extends Model
{
    protected $table = 'livestreams';
    protected $fillable = ['title','description','image','status','mentor_id','stream_key'];
    use HasFactory;
}
