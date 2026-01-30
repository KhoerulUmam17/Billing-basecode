<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class ManajemenAkunUsersTest extends TestCase
{
    // public User $data;

    // public $name;

    /** @test */
    public function it_can_register_a_new_account()
    {
        $data = [
            'name' => 'guru',
            'email' => 'guru2@gmail.com',
            'role' => 'guru',
            'password' => 'mylian214',
            'status' => 'AKTIF',
        ];

        // Menjalankan create user dengan mengirimkan data inputan
        User::create($data);

        // Verifikasi apakah proses pendaftaran berhasil
        $this->assertDatabaseHas('users', [
            'name' => $data['name'],
            'email' => $data['email'],
        ]);
    }

    /** @test */
    public function it_validates_unique_email()
    {
        // Buat user pertama dengan email unik
        $user1 = User::factory()->create([
            'email' => 'unique@example.com',
        ]);

        $data = [
            'name' => 'John Doe',
            'email' => 'unique@example.com',
            'role' => 'guru',
            'password' => 'password',
            'status' => 'AKTIF',
        ];

        // Coba daftarkan user baru dengan email yang sama seperti user pertama
        $response = User::create($data);

        // Memastikan data user baru tidak ada di dalam tabel users
        $this->assertDatabaseMissing('users', [
            'name' => $data['name'],
            'email' => $data['email'],
        ]);
    }
}
