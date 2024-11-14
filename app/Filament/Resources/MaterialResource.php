<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MaterialResource\Pages;
use App\Filament\Resources\MaterialResource\RelationManagers;
use App\Models\Material;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use function Laravel\Prompts\select;

class MaterialResource extends Resource
{
    protected static ?string $model = Material::class;

    protected static ?string $navigationIcon = 'heroicon-o-beaker';

    protected static ?string $navigationGroup = 'Inventory Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('material_id')
                    ->disabled()
                    ->maxLength(255),
                TextInput::make('material_name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('category')
                    ->required()
                    ->maxLength(255),
                TextInput::make('initial_qty')
                    ->required()
                    ->numeric(),
                // TextInput::make('unit')
                //     ->required()
                //     ->maxLength(255),
                Select::make('unit')->options([
                    'kg' => 'kg',
                    'g' => 'g',
                    'ml' => 'ml',
                    'l' => 'l',
                    'piece' => 'piece',

                ]),
                TextInput::make('available_qty')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('material_id')->sortable()->searchable(),
                TextColumn::make('material_name')->sortable()->searchable(),
                TextColumn::make('category')->sortable(),
                TextColumn::make('initial_qty')->sortable(),
                TextColumn::make('unit')->sortable(),
                TextColumn::make('available_qty')->sortable(),
                TextColumn::make('created_at')->dateTime()->sortable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListMaterials::route('/'),
            'create' => Pages\CreateMaterial::route('/create'),
            'edit' => Pages\EditMaterial::route('/{record}/edit'),
        ];
    }
}
