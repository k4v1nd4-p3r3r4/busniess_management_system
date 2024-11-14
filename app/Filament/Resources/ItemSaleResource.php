<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ItemSaleResource\Pages;
use App\Filament\Resources\ItemSaleResource\RelationManagers;
use App\Models\ItemSale;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ItemSaleResource extends Resource
{
    protected static ?string $model = ItemSale::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $navigationGroup = 'Inventory Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('sale_id')
                ->label('Sale ID')
                ->disabled(),

            Forms\Components\Select::make('item_id')
                ->relationship('handlist', 'item_name') // Ensure 'item_name' exists in the Handlist model
                ->required()
                ->label('Item'),

            Forms\Components\Select::make('customer_id')
                ->relationship('customer', 'first_name') // Ensure 'customer_name' exists in the Customer model
                ->required()
                ->label('Customer'),

            Forms\Components\DatePicker::make('date')
                ->required()
                ->label('Date'),

            Forms\Components\TextInput::make('qty')
                ->numeric()
                ->required()
                ->label('Quantity'),

            Forms\Components\TextInput::make('unit_price')
                ->numeric()
                ->required()
                ->label('Unit Price'),

            Forms\Components\TextInput::make('total_amount')
                ->numeric()
                ->label('Total Amount')
                ->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sale_id')
                ->label('Sale ID')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('handlist.item_name') // Adjust as necessary
                ->label('Item'),

            Tables\Columns\TextColumn::make('customer.first_name') // Adjust as necessary
                ->label('Customer'),

            Tables\Columns\TextColumn::make('date')
                ->label('Date')
                ->date()
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('qty')
                ->label('Quantity'),

            Tables\Columns\TextColumn::make('unit_price')
                ->label('Unit Price'),

            Tables\Columns\TextColumn::make('total_amount')
                ->label('Total Amount'),
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
            'index' => Pages\ListItemSales::route('/'),
            'create' => Pages\CreateItemSale::route('/create'),
            'edit' => Pages\EditItemSale::route('/{record}/edit'),
        ];
    }
}
