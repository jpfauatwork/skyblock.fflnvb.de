<?php

namespace Infrastructure\Helpers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use SplFileInfo;
use Symfony\Component\Finder\Finder;

class DiscoverCommandsHelper
{
    public function __construct(
        protected App $app,
        protected string $basePath,
        protected string $path,
    ) {}

    /**
     * @return array<class-string>
     */
    public function execute(): array
    {
        $namespaces = [];

        if (! is_dir($this->path)) {
            return [];
        }

        foreach (Finder::create()->in($this->path)->files() as $file) {
            $namespaces[] = $this->namespaceFromFile($file);
        }

        return $namespaces;
    }

    protected function namespaceFromFile(SplFileInfo $file): string
    {
        return str_replace(
            ['/', '.php'],
            ['\\', ''],
            Str::after(
                $file->getRealPath(),
                app()->basePath($this->basePath).DIRECTORY_SEPARATOR,
            )
        );
    }
}
