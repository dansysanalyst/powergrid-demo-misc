<?php

declare(strict_types = 1);

namespace App\ValueObjects;

use App\Actions\{ParseAnnotation, ParseComponentCode};
use Illuminate\Support\Facades\File;
use Symfony\Component\Finder\SplFileInfo;

final class PowergridExample
{
    public function __construct(
        private string $title,
        private string $description,
        private string $route,
        private string $code,
        private string $class
    ) {
    }

    public static function fromFile(SplFileInfo $file): self
    {
        $code = ParseComponentCode::handle(File::get($file));

        $class       = 'App\\Http\\Livewire\\' . str_replace('.php', '', $file->getRelativePathname());
        $annotations = ParseAnnotation::handle($class);

        return new self($annotations['title'], $annotations['description'], $annotations['route'], $code, $class);
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getRoute(): string
    {
        return $this->route;
    }
}
