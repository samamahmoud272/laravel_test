<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\JobService;
use App\Http\Requests\JobRequest;
use Illuminate\Support\Facades\Gate;

use App\Http\Requests\JobApplicationRequest;
use App\Models\Jobapplication;
use Illuminate\Support\Facades\Auth;
use App\Events\JobApplicationSubmitted;
use App\Models\File;
use App\Models\Availablejobs;
use App\Services\JobApplicationService;
class jobController extends Controller
{
    protected JobService $jobService;

    protected JobApplicationService $jobApplicationService;

    public function __construct(JobService $jobService, JobApplicationService $jobApplicationService)
    {
        $this->jobService = $jobService;
        $this->jobApplicationService = $jobApplicationService;
    }

    public function addjob(JobRequest $request)
    {  
        if (!Gate::allows('is-admin')) {
            return response()->json(['error' => 'Unauthorized: Only admins can add jobs'], 403);
        }

        $jobs = $this->jobService->createJob($request->validated()['jobs']);

        return response()->json(['message' => 'Job added successfully!', 'job' => $jobs], 201);
    }

    public function apply(JobApplicationRequest $request)
    {
        if (Jobapplication::where('user_id', Auth::id())->where('availablejobs_id', $request->availablejobs_id)->exists()) {
            return response()->json(['error' => 'You have already applied for this job'], 400);
        }
        $application = $this->jobApplicationService->createJobApllication($request->validated());

        // Broadcast to Admins
        event(new JobApplicationSubmitted($application));

        return response()->json([
            'message' => 'Job application submitted successfully!',
            'application' => $application
        ], 201);
    }
}
