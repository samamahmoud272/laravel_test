<?php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\JobApplication;

class JobApplicationSubmitted implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $application;

    public function __construct(JobApplication $application)
    {
        $this->application = $application->load('user'); 
    }


    public function broadcastOn()
    {
        return new PrivateChannel('admin.notifications');
    }

    public function broadcastWith()
    {
        return [
            'availablejobs_id' => $this->application->availablejobs_id,
            'user' => [
                'id' => $this->application->user->id,
                'name' => $this->application->user->name,
            ],
            'applied_at' => $this->application->created_at->toDateTimeString(),
        ];
    }
}
