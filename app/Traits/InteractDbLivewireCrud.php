<?php

namespace App\Traits;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;

trait InteractDbLivewireCrud
{
    use LivewireAlert, WithPagination;

    public array $form = [];

    public int $key = 0;

    // protected int $formColumn = 1;

    protected string $displayKey = 'id';

    protected string $displayDelete = 'name';

    protected string $title = 'Data';

    public bool $modalCreate = false;

    public bool $modalEdit = false;

    public bool $modalDelete = false;

    // protected function paginationView()
    // {
    //     return 'vendor.livewire.tailwind';
    // }

    public function resetFields()
    {
        $this->form = [];
        $this->resetErrorBag();
    }

    public function cancelModal()
    {
        $this->modalCreate = false;
        $this->modalEdit = false;
        $this->modalDelete = false;
        $this->form = [];
        $this->resetErrorBag();
    }

    public function dataQuery()
    {
        $data = $this->builder()->orderBy('id', 'desc')->paginate(15);

        return $data;
    }

    public function findData($id)
    {
        $payload = $this->builder()->find($id);
        // dd($payload, $id);
        foreach (collect($payload) as $index => $value) {
            $this->form[$index] = $value;
        }
    }

    public function payload(): array
    {
        $payload = [];
        foreach ($this->fields() as $field) {
            $payload[$field['data']['name']] = $this->form[$field['data']['name']] ?? '';
        }

        return $payload;
    }

    public function validasiForm($validateType = 'create' | 'edit')
    {
        foreach ($this->fields() as $field) {
            if (in_array($validateType, $field['data']['hide'])) {
                continue;
            }
            $key = 'form.'.$field['data']['name'];
            $value = $field['data']['rules'];
            $data[$key] = $value;
        }

        return $data;
    }

    public function create()
    {
        $this->modalCreate = true;
        $this->form = [];
    }

    public function beforeStore($payload)
    {
        return $payload;
    }

    public function store()
    {
        // dd($this->validasiForm('create'));
        // dd($this->validate($this->validasiForm('create')));
        $this->validate($this->validasiForm('create'));

        $payload = $this->payload();
        $payload = $this->beforeStore($payload);

        try {
            $this->builder()->create($payload);
            $this->alert('success', 'Data berhasil dibuat.');
            $this->resetFields();
            $this->modalCreate = false;
        } catch (\Exception $ex) {
            $this->alert('error', 'ada kesalahan!. '.$ex->getMessage());
        }
    }

    public function edit($id)
    {
        $this->key = $id;
        $this->findData($id);
        $this->modalEdit = true;
    }

    public function update()
    {
        $this->validate($this->validasiForm('edit'));

        $payload = $this->payload();

        try {
            $this->builder()->find($this->key)->update($payload);
            $this->alert('success', 'Data berhasil diupdate.');
            $this->resetFields();
            $this->modalEdit = false;
            $this->key = 0;
        } catch (\Exception $ex) {
            $this->alert('error', 'ada kesalahan!. '.$ex->getMessage());
        }
    }

    public function confirmDelete($id)
    {
        $this->key = $id;
        $this->findData($id);
        $this->modalDelete = true;
    }

    public function delete()
    {
        try {
            $this->builder()->find($this->key)->delete();
            $this->alert('success', 'Data berhasil dihapus.');
            $this->resetFields();
            $this->modalDelete = false;
            $this->key = 0;
        } catch (\Exception $ex) {
            $this->alert('error', 'ada kesalahan!. '.$ex->getMessage());
        }
    }
}
