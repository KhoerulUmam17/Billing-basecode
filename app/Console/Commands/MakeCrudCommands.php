<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;

class MakeCrudCommands extends Command
{
    protected $signature = 'make:crud {nama_class} {nama_models} {nama_permissions}';

    protected $description = 'Membuat file Livewire baru dengan custom stub';

    public function handle()
    {
        $nama_class = $this->argument('nama_class');
        $nama_models = $this->argument('nama_models');
        $nama_permissions = strtolower($this->argument('nama_permissions')) ?? '';
        $nama_view = Str::kebab($nama_class);

        $arr = preg_split('/(?=[A-Z])/', $nama_class, -1, PREG_SPLIT_NO_EMPTY);
        $title = $arr[0];

        $class_path = app_path("Http/Livewire/{$nama_class}.php");
        $view_path = resource_path("views/livewire/crud/{$nama_view}.blade.php");

        $folderPath = resource_path('views/livewire/crud');
        // Check if folder already exists
        if (! is_dir($folderPath)) {
            // If folder does not exist, create it
            mkdir($folderPath, 0755, true);
        }

        if (! empty($nama_permissions)) {
            Permission::create(['name' => $nama_permissions]);
            Permission::create(['name' => $nama_permissions.'.list']);
            Permission::create(['name' => $nama_permissions.'.create']);
            Permission::create(['name' => $nama_permissions.'.edit']);
            Permission::create(['name' => $nama_permissions.'.delete']);
        }

        if (File::exists($class_path) || File::exists($view_path)) {
            $this->error('File sudah ada.');

            return;
        }

        $class_content = Str::replace(['{{ class }}', '{{ kebab_class }}', '{{ title }}', '{{ models }}', '{{ security }}'], [$nama_class, $nama_view, $title, $nama_models, $nama_permissions], File::get(resource_path('stubs/livewire-class.stub')));
        $view_content = Str::replace(['{{ title }}', '{{kebab_class}}'], [$title, $nama_view], File::get(resource_path('stubs/livewire-view.stub')));

        File::put($class_path, $class_content);
        File::put($view_path, $view_content);

        $this->info("File Livewire berhasil dibuat di: {$class_path}");
        $this->info("File view berhasil dibuat di: {$view_path}");
    }
}
