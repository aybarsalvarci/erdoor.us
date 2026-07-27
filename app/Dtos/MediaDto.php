<?php

namespace App\Dtos;

use App\Models\Media;

readonly class MediaDto
{
    public function __construct(
        public string  $path,
        public ?string $alt_text
    )
    {
    }

    public static function fromModel(Media $media): self
    {
        return new self(path: $media->path, alt_text: $media->alt_text);
    }
}
