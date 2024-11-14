<?php

namespace App\Filament\Resources\ManuitemResource\Pages;

use App\Filament\Resources\ManuitemResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditManuitem extends EditRecord
{
    protected static string $resource = ManuitemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
