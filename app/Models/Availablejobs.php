<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Availablejobs extends Model
{
    use HasFactory;
    protected $table = 'availablejobs';
    protected $fillable = ['title', 'description', 'location', 'salary', 'created_by'];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
