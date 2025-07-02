<?php

namespace App\Filament\Resources\TopicResource\Pages;

use App\Models\Topic;
use Filament\Actions;
use Filament\Support\Enums\MaxWidth;
use App\Filament\Resources\TopicResource;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\ManageRecords;

class ManageTopics extends ManageRecords
{
    protected static string $resource = TopicResource::class;

    public ?string $chapter_id = null;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->using(function (array $data) {
                    $data['chapter_id'] = $this->chapter_id;

                    return Topic::create($data);
                }),
        ];
    }

    public function mount(): void
    {
        $this->chapter_id = request()->get('chapter_id');

        parent::mount();
    }

    protected function getTableQuery(): ?Builder
    {
        $query = parent::getTableQuery();

        if ($this->chapter_id) {
            $query->where('chapter_id', $this->chapter_id);
        }

        return $query;
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if ($this->chapter_id) {
            $data['chapter_id'] = $this->chapter_id;
        }

        return $data;
    }
}
