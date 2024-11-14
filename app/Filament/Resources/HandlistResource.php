<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HandlistResource\Pages;
use App\Filament\Resources\HandlistResource\RelationManagers;
use App\Models\Handlist;
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

class HandlistResource extends Resource
{
    protected static ?string $model = Handlist::class;

    protected static ?string $navigationIcon = 'heroicon-o-list-bullet';

    protected static ?string $navigationGroup = 'Inventory Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('item_id')
                    ->disabled(), // Disable to prevent manual entry
                TextInput::make('item_name')
                    ->required()
                    ->maxLength(255),
                Select::make('unit')
                    ->required()
                    ->options([
                        'kg' => 'kg',
                        'g' => 'g',
                        'ml' => 'ml',
                        'l' => 'l',
                        'piece' => 'piece',
                    ]),
                TextInput::make('qty')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('item_id')->sortable()->searchable(),
                TextColumn::make('item_name')->sortable()->searchable(),
                TextColumn::make('unit')->sortable(),
                TextColumn::make('qty')->sortable(),
                TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListHandlists::route('/'),
            'create' => Pages\CreateHandlist::route('/create'),
            'edit' => Pages\EditHandlist::route('/{record}/edit'),
        ];
    }
}
