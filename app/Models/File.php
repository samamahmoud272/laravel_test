<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
class File extends Model
{
    use HasFactory;

    protected $fillable = ['path', 'user_id', 'expires_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

 
    public function isExpired()
    {
        return $this->expires_at && now()->greaterThan($this->expires_at);
    }

    public function deleteFile()
    {
        Storage::delete($this->path);
        $this->delete();
    }
}
