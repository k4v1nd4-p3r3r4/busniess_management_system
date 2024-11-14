<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ManuitemResource\Pages;
use App\Filament\Resources\ManuitemResource\RelationManagers;
use App\Models\handlist;
use App\Models\Manuitem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ManuitemResource extends Resource
{
    protected static ?string $model = Manuitem::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-library';

    protected static ?string $navigationGroup = 'Inventory Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('manu_id')
                    ->label('Manufacturing ID')
                    ->disabled()
                    ->default(function () {
                        return Manuitem::generateManuId(); // Auto-generate manu_id
                    }),
                Forms\Components\Select::make('item_id')
                ->relationship('handlist', 'item_name')
                ->required()
                ->label('Item Name'),

                Forms\Components\TextInput::make('qty')
                    ->numeric()
                    ->label('Quantity')
                    ->required(),

                Forms\Components\DatePicker::make('date')
                    ->required()
                    ->label('Date'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('manu_id')
                ->label('Manufacturing ID')
                ->sortable()
                ->searchable(),

                Tables\Columns\TextColumn::make('handlist.item_name')
                ->label('Item Name'),

                Tables\Columns\TextColumn::make('qty')
                ->label('Quantity'),

                Tables\Columns\TextColumn::make('date')->date()
                ->sortable()
                ->searchable(),
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
            'index' => Pages\ListManuitems::route('/'),
            'create' => Pages\CreateManuitem::route('/create'),
            'edit' => Pages\EditManuitem::route('/{record}/edit'),
        ];
    }
}
