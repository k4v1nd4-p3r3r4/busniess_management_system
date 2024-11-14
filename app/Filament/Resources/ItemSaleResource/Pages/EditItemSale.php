<?php

namespace App\Filament\Resources\ItemSaleResource\Pages;

use App\Filament\Resources\ItemSaleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditItemSale extends EditRecord
{
    protected static string $resource = ItemSaleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
