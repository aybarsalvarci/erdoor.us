<?php

namespace App\Dtos;

use App\Models\Slider;

readonly class SliderDto
{
    public function __construct(
        public int $order,
        public bool $status,
        public ?string $url = null,
        public ?MediaDto $image = null,
    ){}

    public static function fromModel(Slider $slider): self
    {
        return new self(
            order: $slider->order,
            status: $slider->status,
            url: $slider->url,
            image: $slider->image ? MediaDto::fromModel($slider->image) : null,
        );
    }
}
