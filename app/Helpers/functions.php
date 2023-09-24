<?php

use Illuminate\Http\UploadedFile;

if (! function_exists('getArrayFile')) {
    function getArrayFile(UploadedFile $file = null): ?array
    {
        if (! $file) {
            return null;
        }

        return [
            'name' => $file->getClientOriginalName(),
            'tmp_name' => $file->getPathname(),
            'size' => $file->getSize(),
            'error' => $file->getError(),
            'type' => $file->getType(),
        ];
    }
}

if (! function_exists('convertArrayToObject')) {
    function convertArrayToObjects(array $data): array
    {
        $response = [];

        foreach ($data as $item) {
            $stdClass = new \stdClass;
            foreach ($item as $key => $value) {
                $stdClass->{$key} = $value;
            }
            $response[] = $stdClass;
        }

        return $response;
    }
}
