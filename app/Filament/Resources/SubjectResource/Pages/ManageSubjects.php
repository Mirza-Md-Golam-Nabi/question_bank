<?php

namespace App\Filament\Resources\SubjectResource\Pages;

use Filament\Actions;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\SubjectResource;
use Filament\Resources\Pages\ManageRecords;
use Filament\Support\Enums\MaxWidth;

class ManageSubjects extends ManageRecords
{
    protected static string $resource = SubjectResource::class;

    public ?string $department_id = null;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->modalWidth(MaxWidth::Medium)
                ->using(function (array $data) {
                    $data['department_id'] = $this->department_id;

                    return Subject::create($data);
                }),
        ];
    }

    public function mount(): void
    {
        $this->department_id = request()->get('department_id');

        parent::mount();
    }

    protected function getTableQuery(): Builder
    {
        $query = parent::getTableQuery();

        if ($this->department_id) {
            $query->where('department_id', $this->department_id);
        }

        return $query;
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if ($this->department_id) {
            $data['department_id'] = $this->department_id;
        }

        return $data;
    }
}
