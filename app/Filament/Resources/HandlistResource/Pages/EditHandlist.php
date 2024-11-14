<?php

namespace App\Filament\Resources\HandlistResource\Pages;

use App\Filament\Resources\HandlistResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHandlist extends EditRecord
{
    protected static string $resource = HandlistResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
