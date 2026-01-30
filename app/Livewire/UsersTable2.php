<?php

namespace App\Livewire;

use App\Models\User;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class UsersTable2 extends Component implements HasTable, HasForms
{
    use InteractsWithTable;
    use InteractsWithForms;
    use LivewireAlert;

    public function table(Table $table): Table
    {
        return $table
            ->query(User::query())
            ->headerActions([
                CreateAction::make()
                    ->form([
                        Grid::make(2)
                        ->schema([
                            FileUpload::make('photo')
                                ->disk('public')
                                ->directory('profile-photos')
                                ->visibility('private'),
                            TextInput::make('name')->required(),
                            TextInput::make('nik')->required()->maxValue(16)->maxLength(16)->regex('/^[0-9]+$/'),
                            TextInput::make('username')->required(),
                            TextInput::make('email')->required()->unique(),
                            TextInput::make('mobile_phone')->required(),
                            TextInput::make('password')->password()->required(),
                            Toggle::make('is_status')->label('Status')->required(),
                        ])
                    ])->after(function() {
                        $this->alert('success', 'The user has been created');
                    }),
            ])
            ->columns([
                ImageColumn::make('photo')->disk('public')->visibility(true)->circular()->extraImgAttributes(['loading' => 'lazy']),
                TextColumn::make('name')->searchable(isIndividual: true),
                TextColumn::make('username')->searchable(),
                TextColumn::make('nik')->searchable(),
                TextColumn::make('mobile_phone')->searchable(),
                TextColumn::make('email')->searchable(),
                ToggleColumn::make('is_status')->label('Status')
                    ->beforeStateUpdated(function ($record, $state) {})->afterStateUpdated(function ($record, $state) {
                        $this->alert('success', 'Berhasil update');
                    }),
            ])
            ->actions([
                ActionGroup::make([
                    EditAction::make('Edit')->modalHeading('Edit User')
                        ->form([
                            Grid::make(2)->schema([
                                FileUpload::make('photo')
                                    ->disk('public')
                                    ->directory('profile-photos')
                                    ->visibility('private'),
                                TextInput::make('name')->required(),
                                TextInput::make('nik')->required(),
                                TextInput::make('username')->required(),
                                TextInput::make('email')->required(),
                                TextInput::make('mobile_phone')->required(),
                                Toggle::make('is_status')->label('Status')->required(),
                            ])
                        ])->after(function () {
                            $this->alert('success', 'The user has been saved successfully');
                        }),
                    DeleteAction::make('delete')
                        ->requiresConfirmation()
                        ->action(fn(User $record) => $record->delete())
                        ->after(function () {
                            $this->alert('success', 'The user has been deleted');
                        })
                ])->label('Actions')
                    ->icon('heroicon-m-ellipsis-vertical')
                    ->color('primary')
                    ->button()
            ]);
    }

    public function render()
    {
        return view('livewire.users-table2');
    }
}
