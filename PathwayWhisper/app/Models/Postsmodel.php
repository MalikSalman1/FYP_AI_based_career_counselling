<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postsmodel extends Model
{
    protected $table = 'posts';
    protected $fillable = ['body'];
    // with comments and user
    public function comments()
    {
        return $this->hasMany(Commentsmodel::class, 'post_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    use HasFactory;
}
