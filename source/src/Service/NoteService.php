<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class NoteService
{
    private readonly string $path;

    public function __construct(?string $path = null) 
    {
        $this->path = $path ?? $_ENV['DATA_PATH'];
    }

    public function index(): array
    {
        $files = array_filter(scandir($this->path),
            fn ($file) => str_ends_with($file, '.txt'));

        return array_values($files);
    }

    public function today(string $content): bool
    {
        $date = (new \DateTime())->format('Ymd');
        $filepath = "{$this->path}/{$date}.txt";

        return (bool)file_put_contents($filepath, $content);
    }

    public function show(?string $filename = null): array
    {
        $filepath = "{$this->path}/{$filename}";
        $content = null;

        if (file_exists($filepath)) {
            $content = file_get_contents($filepath);
        }

        if ($content) {
            return [
                'filename' => $filename,
                'content' => $content,
            ];
        }

        return [];
    }

    public function update(string $filename, string $content): bool
    {
        $filepath = "{$this->path}/{$filename}";

        return (bool)file_put_contents($filepath, $content);
    }
}
