<?php

namespace App\Service;

class MapService
{
    public function loadMapFromFile(string $filePath): array
    {
        if (!file_exists($filePath)) {
            throw new \Exception("The map file '{$filePath}' doesn't exist.");
        }

        return file($filePath, FILE_IGNORE_NEW_LINES);
    }

    public function isFieldAccessible(array $mapData, int $x, int $y): bool
    {
        if ($x < 0 || $y < 0 || $x >= count($mapData) || $y >= strlen($mapData[0])) {
            return false;
        }

        return isset($mapData[$x][$y]) && $mapData[$x][$y] === ' ';
    }
}
