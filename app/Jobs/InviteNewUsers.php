<?php

namespace App\Jobs;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class InviteNewUsers
//	implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
	/**
	 * @var array
	 */
	private $users;

	/**
	 * Create a new job instance.
	 *
	 * @param array $users
	 */
    public function __construct(array $users = [])
    {
		$this->users = $users;
	}

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
		foreach ($this->users as $user){
			sleep(10);
			User::create(array_merge($user, [
				'password' => bcrypt('password')
			]));
		}
    }
}
