<?php

namespace App\Jobs;

use App\Models\Contacts;
use App\Models\User;
use App\Notifications\contact\failedUserUploadContact;
use App\Notifications\NotifErrorUploadContact;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ContactsUploadJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;

    public $idUser;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data, $idUser)
    {
        $this->data = $data;
        $this->idUser = $idUser;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = User::where('username', $this->data['assigned_to'])->first();
        $userLogin = User::find($this->idUser);
        if (! $user) {
            // Handle kasus ketika user tidak ditemukan, mungkin dengan mengembalikan pesan error atau log.
            Log::channel('contactsupload')->warning("User with username {$this->data['assigned_to']} not found.");
            $userLogin->notify(new failedUserUploadContact($this->data['assigned_to']));

            return;
        }
        try {
            $group_id = $user->groups()->pluck('uuid')->toArray();

            $this->data['assigned_to'] = $user->uuid;
            $this->data['created_by'] = $this->idUser;
            $this->data['updated_by'] = $this->idUser;

            $contact = Contacts::create($this->data);

            $contact->groups()->attach($group_id);
        } catch (\Exception $e) {
            $userLogin->notify(new NotifErrorUploadContact());
            Log::channel('contactsupload')->alert($e->getMessage(),
                [
                    'data' => $this->data,
                    'group_id' => $group_id,
                ]);
        }
    }
}
