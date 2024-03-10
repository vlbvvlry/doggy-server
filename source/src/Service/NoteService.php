<?php

namespace App\Service;

use App\Utils\FilenameParser;

class NoteService
{
    private readonly string $path;

    public function __construct(?string $path = null) 
    {
        $this->path = $path ?? $_ENV['DATA_PATH'];
    }

    public function all(): array
    {
        $files = scandir($this->path);

        return FilenameParser::toNotes($files);
    }

    public function for(?string $filename = null): array
    {
        return [
            ...FilenameParser::toNote($filename),
            'content' => file_get_contents("{$this->path}/{$filename}"),
        ];
    }
}
