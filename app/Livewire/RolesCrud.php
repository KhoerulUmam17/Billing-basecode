<?php

namespace App\Livewire;

use Illuminate\Support\Collection as SupportCollection;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesCrud extends Component
{
    use LivewireAlert;

    public string $page = 'list';

    protected string $displayKey = 'name';

    protected string $title = 'Roles';

    public int $key = 0;

    public bool $modalDelete = false;

    public SupportCollection $role;

    public SupportCollection $permissionsParent;

    public SupportCollection $permissionsChild;

    public array $rolePermissions = [];

    public function cancelModal()
    {
        $this->key = 0;
        $this->modalDelete = false;
        $this->resetErrorBag();
        $this->page = 'list';

        return redirect()->to('/roles');
    }

    public function render()
    {
        $roles = Role::orderBy('id', 'DESC')->paginate(5);

        return view('livewire.role-crud', ['roles' => $roles]);
    }

    public function edit($id)
    {
        try {
            $this->key = $id;
            $role = Role::find($id);
            $this->role = collect($role);
            $this->permissionsParent = collect(Permission::where('parent', 1)->get());
            $this->permissionsChild = collect(Permission::get());
            $this->rolePermissions = $role->permissions()->pluck('id')->toArray();
            $this->page = 'edit';
        } catch (\Exception $e) {
            $this->alert('error', 'ada kesalahan.');
        }
    }

    public function updateRole()
    {
        try {
            $filteredPermissions = $this->permissionsChild->filter(function ($permission) {
                return in_array($permission['id'], $this->rolePermissions);
            });
            $role = Role::findById($this->role['id'] ?? $this->key);
            $role->name = $this->role['name'];
            $role->save();
            $role->syncPermissions($filteredPermissions->pluck('name')->toArray() ?? []);
            $this->page = 'list';
            $this->alert('success', 'Role '.$this->role['name'].' berhasil di update');
        } catch (\Exception $e) {
            $this->alert('error', 'ada kesalahan.'.$e->getMessage());
        }
    }

    public function confirmDelete($id)
    {
        $this->key = $id;
        $this->modalDelete = true;
    }

    public function delete()
    {
        try {
            Role::findById($this->key)->delete();
            $this->alert('success', 'Role berhasil dihapus.');
            $this->cancelModal();
            $this->modalDelete = false;
            $this->key = 0;
        } catch (\Exception $e) {
            $this->alert('error', 'ada kesalahan!.');
        }
    }
}
