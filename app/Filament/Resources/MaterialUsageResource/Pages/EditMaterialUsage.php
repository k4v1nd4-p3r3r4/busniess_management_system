<?php

namespace App\Filament\Resources\MaterialUsageResource\Pages;

use App\Filament\Resources\MaterialUsageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMaterialUsage extends EditRecord
{
    protected static string $resource = MaterialUsageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
