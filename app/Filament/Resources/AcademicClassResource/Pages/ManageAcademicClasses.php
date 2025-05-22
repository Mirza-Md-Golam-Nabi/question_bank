<?php

namespace App\Filament\Resources\AcademicClassResource\Pages;

use App\Filament\Resources\AcademicClassResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use Filament\Support\Enums\MaxWidth;

class ManageAcademicClasses extends ManageRecords
{
    protected static string $resource = AcademicClassResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->modalWidth(MaxWidth::Medium),
        ];
    }
}
