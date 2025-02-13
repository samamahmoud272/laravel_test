<?php
namespace App\Services;

use App\Models\Availablejobs;
use Illuminate\Support\Facades\Auth;

class JobService
{
    /**
     * Create a new job (Admin only).
     */
    public function createJob(array $data)
    {
        $jobs = [];
        foreach ($data as $jobData) {
            $jobs[] = Availablejobs::create([
                'title' => $jobData['title'],
                'description' => $jobData['description'],
                'location' => $jobData['location'],
                'salary' => $jobData['salary'],
                'created_by' => Auth::id(),
            ]);
        

    }
    return $jobs;
    }

}