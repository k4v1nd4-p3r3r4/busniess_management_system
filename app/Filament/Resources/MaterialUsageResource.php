<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MaterialUsageResource\Pages;
use App\Filament\Resources\MaterialUsageResource\RelationManagers;
use App\Models\MaterialUsage;
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

class MaterialUsageResource extends Resource
{
    protected static ?string $model = MaterialUsage::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox-arrow-down';

    protected static ?string $navigationGroup = 'Inventory Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('usage_id')
                    ->label('Usage ID')
                    ->disabled() // Make the field disabled since it will be auto-generated
                    ->default('Will be generated automatically'),
                Select::make('material_id')
                    ->relationship('material', 'material_name')
                    ->required(),
                DatePicker::make('date')
                    ->required(),
                TextInput::make('usage_qty')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('usage_id')->label('Usage ID')->sortable()->searchable(),
                TextColumn::make('material.material_name')->label('Material Name')->sortable()->searchable(),
                TextColumn::make('date')->sortable()->dateTime(),
                TextColumn::make('usage_qty')->sortable(),
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
            'index' => Pages\ListMaterialUsages::route('/'),
            'create' => Pages\CreateMaterialUsage::route('/create'),
            'edit' => Pages\EditMaterialUsage::route('/{record}/edit'),
        ];
    }
}
