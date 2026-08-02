<?php

namespace App\Dtos;

use App\Models\Door;

readonly class DoorDto
{
    public function __construct(
        public int $id,
        public ?string $collectionName,
        public string $name,
        public string $slug,
        public ?string $description,
        public ?MediaDto $media,
        public ?MediaDto $specMedia
    ){}

    public static function fromModel(Door $model): self
    {
        return new self(
            id: $model->id,
            collectionName: $model->collection_name,
            name: $model->name,
            slug: $model->slug,
            description: $model->description,
            media: $model->image ? MediaDto::fromModel($model->image) : null,
            specMedia: $model->spesificationImage ? MediaDto::fromModel($model->spesificationImage) : null
        );
    }
}
