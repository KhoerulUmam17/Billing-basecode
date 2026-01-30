<?php

namespace App\Jobs;

use App\Mail\changeStatusContactMail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class changeStatusContactJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $uuid;

    public $oldStatus;

    public $status;

    public $idContact;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($uuid, $oldStatus, $status, $idContact)
    {
        $this->uuid = $uuid;
        $this->oldStatus = $oldStatus;
        $this->status = $status;
        $this->idContact = $idContact;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = [];
        try {
            $uuid = $this->uuid;
            $user = User::where('uuid', $uuid)->firstOrFail();
            $data['name'] = $user->name;
            $data['oldStatus'] = $this->oldStatus;
            $data['status'] = $this->status;
            $data['id'] = $this->idContact;
            Mail::to('mylian@cloudku.id')->send(new changeStatusContactMail($data));
            // Mail::to($user->email)->send(new changeStatusContactMail());
        } catch (\Exception $e) {
            Log::channel('contact')->alert($e->getMessage());
        }

    }
}
