<?php

namespace App\Jobs;

use App\Models\Groups;
use App\Models\User;
use App\Notifications\NotifErrorUploadUsers;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UsersUploadJob implements ShouldQueue
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
        $userLogin = User::find($this->idUser);
        try {
            $data = $this->data;
            $role = strtolower(trim($data['role']));
            $groupName = $data['group'];
            unset($data['role']);
            unset($data['group']);
            $data['mobile_phone'] = $this->generatePhone($data['mobile_phone']);
            if (empty($data['nik']) || is_null($data['nik'])) {
                $data['nik'] = '#'.$data['username'].'(perbaiki)';
            }
            $user = User::create($data);
            $user->assignRole($role);

            $groupNames = explode(',', $groupName);
            foreach ($groupNames as $name) {
                $group = Groups::where('name', trim($name))->firstOrFail();
                DB::table('user_group')->insert(['user_uuid' => $user->uuid, 'group_uuid' => $group->uuid]);
            }

        } catch (\Exception $e) {
            Log::channel('userupload')->alert($e->getMessage(), ['data' => $this->data]);
            $userLogin->notify(new NotifErrorUploadUsers($this->data['username']));
        }
    }

    public function generatePhone($phone)
    {
        $numericPhoneNumber = preg_replace('/\D/', '', $phone);
        // Menambahkan '62' jika nomor tidak diawali dengan '62'
        $internationalPhoneNumber = substr($numericPhoneNumber, 0, 2) === '62' ? $numericPhoneNumber : '62'.ltrim($numericPhoneNumber, '0');

        return $internationalPhoneNumber;
    }
}
