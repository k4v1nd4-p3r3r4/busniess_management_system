<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FoodsaleResource\Pages;
use App\Filament\Resources\FoodsaleResource\RelationManagers;
use App\Models\Foodsale;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FoodsaleResource extends Resource
{
    protected static ?string $model = Foodsale::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-currency-dollar';

    protected static ?string $navigationGroup = 'Inventory Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('food_id')
                ->relationship('food', 'food_name') // Assuming 'name' is a field in the 'foodlist' table
                ->required(),

            Forms\Components\Select::make('customer_id')
            ->relationship('customer', 'first_name') // Correct relationship and fiel// Assuming 'name' is a field in the 'customer' table
                ->required(),

            Forms\Components\DatePicker::make('date')
                ->required(),

            Forms\Components\TextInput::make('qty')
                ->numeric()
                ->required(),

            Forms\Components\TextInput::make('unit_price')
                ->numeric()
                ->required(),

            Forms\Components\TextInput::make('total_amount')
                ->numeric()

                ->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sale_id')->label('Sale ID'),
                Tables\Columns\TextColumn::make('food.food_name')->label('Food Name'),
                Tables\Columns\TextColumn::make('customer.first_name')->label('Customer Name'),
                Tables\Columns\TextColumn::make('date')->date(),
                Tables\Columns\TextColumn::make('qty'),
                Tables\Columns\TextColumn::make('unit_price'),
                Tables\Columns\TextColumn::make('total_amount'),
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
            'index' => Pages\ListFoodsales::route('/'),
            'create' => Pages\CreateFoodsale::route('/create'),
            'edit' => Pages\EditFoodsale::route('/{record}/edit'),
        ];
    }
}
