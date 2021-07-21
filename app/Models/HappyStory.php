<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HappyStory extends Model
{
    use HasFactory;

    public function happyStoryMember()
    {
        return $this->belongsTo(Member::class,'posted_by');
    }
}
