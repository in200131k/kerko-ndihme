<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = ['description', 'user_id', 'question_id'];

    public function votes(): MorphMany
    {
        return $this->morphMany(Vote::class, 'votable');
    }
}
