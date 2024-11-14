<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Filament\Resources\EmployeeResource\RelationManagers;
use App\Models\Employee;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('employee_id')
                    ->label('Employee ID')
                    ->disabled(),  // Disable the input field as it's auto-generated

                TextInput::make('first_name')
                    ->label('First Name')
                    ->required(),

                TextInput::make('last_name')
                    ->label('Last Name')
                    ->required(),

                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->unique(ignoreRecord: true)
                    ->required(),

                TextInput::make('phone_number')
                    ->label('Phone Number')
                    ->required(),

                DatePicker::make('date_of_birth')
                    ->label('Date of Birth')
                    ->required(),

                DatePicker::make('hire_date')
                    ->label('Hire Date')
                    ->required(),

                TextInput::make('department')
                    ->label('Department')
                    ->required(),

                TextInput::make('position')
                    ->label('Position')
                    ->required(),

                TextInput::make('base_salary')
                    ->label('Base Salary')
                    ->numeric()
                    ->required(),

                TextInput::make('daily_wage')
                    ->label('Daily Wage')
                    ->numeric()
                    ->required(),

                Select::make('status')
                    ->label('Status')
                    ->options([
                        'Active' => 'Active',
                        'Inactive' => 'Inactive',
                    ])
                    ->default('Active')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('employee_id')
                ->label('Employee ID')
                ->sortable()
                ->searchable(),

            TextColumn::make('first_name')
                ->label('First Name')
                ->sortable()
                ->searchable(),

            TextColumn::make('last_name')
                ->label('Last Name')
                ->sortable()
                ->searchable(),

            TextColumn::make('email')
                ->label('Email')
                ->sortable()
                ->searchable(),

            TextColumn::make('phone_number')
                ->label('Phone Number')
                ->sortable(),

            TextColumn::make('department')
                ->label('Department')
                ->sortable()
                ->searchable(),

            TextColumn::make('position')
                ->label('Position')
                ->sortable()
                ->searchable(),

            TextColumn::make('hire_date')
                ->label('Hire Date')
                ->sortable(),

            TextColumn::make('status')
                ->label('Status')
                ->sortable()
                ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
