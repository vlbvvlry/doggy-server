<?php

namespace App\Utils;

class FilenameParser
{
    public static function toNotes(array $files): array
    {
        $notes = [];

        foreach ($files as $file) {
            $file = explode('.', $file)[0];

            if (empty($file)) {
                continue;
            }

            $split = explode(' ', $file);
            $note['filename'] = $file;
            $note['date'] = $split[0];
            $notes[] = $note;
        }

        $notes = array_map(fn (string $filename) => static::toNote($filename), $files);
        $notes = array_filter($notes, fn ($note) => $note !== []);

        return $notes;
    }

    public static function toNote(?string $filename): array
    {
        $nude = explode('.', $filename)[0];

        if (empty($nude)) {
            return [];
        }

        $split = explode(' ', $nude);

        return [
            'filename' => $filename,
            'date' =>$split[0],
            'label' => $split[1] ?? null,
        ];
    }
}
