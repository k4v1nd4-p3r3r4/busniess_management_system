<?php

namespace App\Filament\Resources\ItemSaleResource\Pages;

use App\Filament\Resources\ItemSaleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListItemSales extends ListRecords
{
    protected static string $resource = ItemSaleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
