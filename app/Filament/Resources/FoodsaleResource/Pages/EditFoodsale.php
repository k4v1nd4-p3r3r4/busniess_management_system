<?php

namespace App\Filament\Resources\FoodsaleResource\Pages;

use App\Filament\Resources\FoodsaleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFoodsale extends EditRecord
{
    protected static string $resource = FoodsaleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
