<?php

namespace App\Events;

use App\Api;
use App\ApiCall;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ApiCalled
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
	/**
	 * @var Api
	 */
	private $api_call;

	/**
	 * Create a new event instance.
	 *
	 * @param Api $call
	 */
    public function __construct(ApiCall $call)
    {
		$this->api_call = $call;
	}

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
