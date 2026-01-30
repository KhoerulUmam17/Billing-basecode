<?php

namespace App\Jobs;

use App\Models\TelegramHelpers;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TelegramJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected array $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->data['jenis'] == 'register') {
            $data = $this->data;
            TelegramHelpers::telegram_chat_register_akun($data);
        }
        if ($this->data['jenis'] == 'kendala') {
            $data = $this->data;
            TelegramHelpers::telegram_chat_complaints($data);
        }
        if ($this->data['jenis'] == 'activate') {
            $data = $this->data;
            TelegramHelpers::telegram_chat_activate_akun($data);
        }
        if ($this->data['jenis'] == 'deactivate') {
            $data = $this->data;
            TelegramHelpers::telegram_chat_deactivate_akun($data);
        }
    }
}
