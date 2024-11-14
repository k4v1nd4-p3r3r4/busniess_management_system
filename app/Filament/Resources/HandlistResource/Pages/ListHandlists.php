<?php

namespace App\Filament\Resources\HandlistResource\Pages;

use App\Filament\Resources\HandlistResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHandlists extends ListRecords
{
    protected static string $resource = HandlistResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
