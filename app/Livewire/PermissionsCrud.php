<?php

// namespace App\Livewire;

// use App\Traits\InteractPowerGridCrud;
// use Carbon\Carbon;
// use Illuminate\Contracts\Database\Eloquent\Builder;
// use PowerComponents\LivewirePowerGrid\Column;
// use PowerComponents\LivewirePowerGrid\Footer;
// use PowerComponents\LivewirePowerGrid\Header;
// use PowerComponents\LivewirePowerGrid\PowerGrid;
// use PowerComponents\LivewirePowerGrid\PowerGridComponent;
// use PowerComponents\LivewirePowerGrid\PowerGridEloquent;
// use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
// use Spatie\Permission\Models\Permission;

// class PermissionsCrud extends PowerGridComponent
// {
//     // use ActionButton;
//     use InteractPowerGridCrud;

//     protected string $security = 'permissions';

//     protected string $title = 'Permissions';

//     protected string $displayKey = 'id';

//     protected int $formColumn = 1;

//     public string $sortField = 'updated_at';

//     public string $sortDirection = 'desc';

//     /*
//     |--------------------------------------------------------------------------
//     |  Features Setup
//     |--------------------------------------------------------------------------
//     | Setup Table's general features
//     |
//     */
//     public function setUp(): array
//     {
//         // $this->showCheckBox();

//         return [
//             Header::make()->showSearchInput()
//                 ->includeViewOnTop('livewire.crud.permissions-crud'),
//             Footer::make()
//                 ->showPerPage()
//                 ->showRecordCount(),
//         ];
//     }

//     /**
//      * PowerGrid datasource.
//      *
//      * @return Builder<\App\Models\Permission>
//      */
//     public function datasource(): Builder
//     {
//         return Permission::query();
//     }

//     /**
//      * Relationship search.
//      *
//      * @return array<string, array<int, string>>
//      */
//     public function relationSearch(): array
//     {
//         return [

//         ];
//     }

//     public function addColumns(): PowerGridEloquent
//     {
//         return PowerGrid::eloquent()
//             ->addColumn('button', function ($model) {
//                 return view('livewire.buttonAction', ['id' => $model->id, 'security' => $this->security]);
//             })
//             ->addColumn('id')
//             ->addColumn('name')
//             ->addColumn('created_at_formatted', fn (Permission $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
//     }

//     /**
//      * PowerGrid Columns.
//      *
//      * @return array<int, Column>
//      */
//     public function columns(): array
//     {
//         return [
//             Column::make('ID', 'id')
//                 ->searchable()->hidden()
//                 ->sortable(),

//             Column::make('Name Permission', 'name')
//                 ->searchable()->sortable(),

//             Column::make('Action', 'button')->visibleInExport(false),
//         ];
//     }

//     /**
//      * PowerGrid Contacts Action Buttons.
//      *
//      * @return array<int, Button>
//      */

//     // public function actions(): array
//     // {
//     //    return [
//     //        Button::make('button', 'Edit'),
//     //     ];
//     // }

//     /**
//      * PowerGrid Contacts Action Rules.
//      *
//      * @return array<int, RuleActions>
//      */

//     /*
//     public function actionRules(): array
//     {
//        return [

//            //Hide button edit for ID 1
//             Rule::button('edit')
//                 ->when(fn($contacts) => $contacts->id === 1)
//                 ->hide(),
//         ];
//     }
//     */

//     public function store()
//     {
//         $this->validate($this->validasiForm('create'));

//         $payload = $this->payload();

//         try {
//             if ($payload['parent'] == 1) {
//                 Permission::create($payload);
//                 Permission::create(['name' => $payload['name'].'.list']);
//                 Permission::create(['name' => $payload['name'].'.create']);
//                 Permission::create(['name' => $payload['name'].'.edit']);
//                 Permission::create(['name' => $payload['name'].'.delete']);
//             } elseif ($payload['parent'] == 0) {
//                 Permission::create($payload);
//             }
//             $this->alert('success', 'Data berhasil dibuat.');
//             $this->resetFields();
//             $this->modalCreate = false;
//         } catch (\Exception $ex) {
//             $this->alert('error', 'ada kesalahan!. '.$ex->getMessage());
//         }
//     }

//     public function modals(): array
//     {
//         return [
//             view('livewire.formCreate', ['fields' => $this->fields(), 'title' => $this->title]),
//             view('livewire.formEdit', ['fields' => $this->fields(), 'title' => $this->title]),
//             view('livewire.confirmDelete'),
//         ];
//     }

//     // public function fields(): array
//     // {
//     //     // list type : text, textarea, time, select, password, mail, datetime, date
//     //     // type select perlu menambahkan options di data
//     //     // list hide : index, form-edit, form-create

//     //     return [
//     //         [
//     //             'type' => 'text',
//     //             'data' => [
//     //                 'text' => 'Nama Permissions',
//     //                 'name' => 'name',
//     //                 'rules' => ['required', 'regex:/^[^.]*\.?[^.]*$/', 'regex:/^[^,]*\.?[^,\.]*$/'],
//     //                 'hide' => [],
//     //             ],
//     //         ],
//     //         [
//     //             'type' => 'select',
//     //             'data' => [
//     //                 'text' => 'Permission Parent',
//     //                 'name' => 'parent',
//     //                 'rules' => ['required'],
//     //                 'hide' => [],
//     //                 'options' => [
//     //                     1 => 'Yes',
//     //                     0 => 'No',
//     //                 ],
//     //             ],
//     //         ],

//     //     ];
//     // }
// }
