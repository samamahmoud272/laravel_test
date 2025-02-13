<?php
namespace App\Services;

use App\Models\Jobapplication;
use Illuminate\Support\Facades\Auth;
use App\Models\File;
class jobApplicationService
{
    /**
     * Create a new job (Admin only).
     */
    public function createJobApllication(array $data)
    {
    $application =  Jobapplication::create([
            'user_id' => Auth::id(),
            'availablejobs_id' => $data['availablejobs_id'],
            'cover_letter' => $data['cover_letter'],
        ]);

        $path = $data['file']->store('uploads');
        $expires_at = now()->addMonth();
        
        File::create([
            'path' => $path,
            'user_id' => auth()->id(),
            'expires_at' => $expires_at,
        ]);

        return $application;
    }

}