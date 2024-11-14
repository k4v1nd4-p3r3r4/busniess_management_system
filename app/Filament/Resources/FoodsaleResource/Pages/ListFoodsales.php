<?php

namespace App\Filament\Resources\FoodsaleResource\Pages;

use App\Filament\Resources\FoodsaleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFoodsales extends ListRecords
{
    protected static string $resource = FoodsaleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
