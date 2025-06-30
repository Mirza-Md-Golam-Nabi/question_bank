<?php

namespace App\Filament\Resources\DepartmentResource\Pages;

use Filament\Actions;
use App\Models\Department;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\ManageRecords;
use App\Filament\Resources\DepartmentResource;

class ManageDepartments extends ManageRecords
{
    protected static string $resource = DepartmentResource::class;

    public ?string $class_id = null;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->modalWidth(MaxWidth::Medium)
                ->using(function (array $data) {
                    $data['academic_class_id'] = $this->class_id;

                    return Department::create($data);
                }),
        ];
    }

    public function mount(): void
    {
        $this->class_id = request()->get('class_id');

        parent::mount();
    }

    protected function getTableQuery(): Builder
    {
        $query = parent::getTableQuery();

        if ($this->class_id) {
            $query->where('academic_class_id', $this->class_id);
        }

        return $query;
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if ($this->class_id) {
            $data['academic_class_id'] = $this->class_id;
        }

        return $data;
    }
}
