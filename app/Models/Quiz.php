<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quiz extends Model
{
    use HasFactory;
    protected $table = 'quizzes';
    protected $fillable = [
        'name',
        'main_image_link',
        'description',
        'author_id',
        'published'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }
}
