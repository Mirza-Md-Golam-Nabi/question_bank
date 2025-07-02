<?php

namespace App\Filament\Resources\ChapterResource\Pages;

use Filament\Actions;
use App\Models\Chapter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ChapterResource;
use Filament\Resources\Pages\ManageRecords;

class ManageChapters extends ManageRecords
{
    protected static string $resource = ChapterResource::class;

    public ?string $subject_id = null;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->using(function (array $data) {
                    $data['subject_id'] = $this->subject_id;

                    return Chapter::create($data);
                }),
        ];
    }

    public function mount(): void
    {
        $this->subject_id = request()->get('subject_id');

        parent::mount();
    }

    protected function getTableQuery(): ?Builder
    {
        $query = parent::getTableQuery();

        if ($this->subject_id) {
            $query->where('subject_id', $this->subject_id);
        }

        return $query;
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if ($this->subject_id) {
            $data['subject_id'] = $this->subject_id;
        }

        return $data;
    }
}
