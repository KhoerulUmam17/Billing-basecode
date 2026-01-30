<?php

namespace App\Jobs;

use App\Mail\createLeadsMail;
use App\Models\Contacts;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class createLeadsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $leads;

    public $uuid;

    public $idUser;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($leads, $uuid, $idUser)
    {
        $this->leads = $leads;
        $this->uuid = $uuid;
        $this->idUser = $idUser;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        try {
            $leads = $this->leads;
            $contact = Contacts::where('uuid', $this->uuid)->firstOrFail();
            $user = User::where('uuid', $this->idUser)->firstOrFail();
            $data['name'] = $user->name;
            $data['contact_name'] = $contact->name ?? '-';
            $data['leads_name'] = $leads['name'];
            $data['id'] = $contact->uuid;
            Mail::to('mylian@cloudku.id')->send(new createLeadsMail($data));
            // Mail::to($user->email)->send(new createLeadsMail());
        } catch (\Exception $e) {
            Log::channel('contact')->alert($e->getMessage());
        }
    }
}
