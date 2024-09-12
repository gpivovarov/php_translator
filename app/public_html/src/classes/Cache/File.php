<?php
namespace Cache;

class File extends ABSCache
{
    protected static string $cacheDir = 'text_cache';

    private static function getFullPath(string $cacheId): string
    {
        $subDir = preg_replace('/[^1-9]/', '', $cacheId);
        if (empty($subDir)) {
            $subDir = '00';
        } else {
            $subDir = (string)array_sum(array_unique(str_split($subDir)));
        }
        $dirPath = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . self::$cacheDir . DIRECTORY_SEPARATOR . $subDir;
        if (!is_dir($dirPath)) {
            mkdir($dirPath, 0755, true);
        }
        return $dirPath . DIRECTORY_SEPARATOR . $cacheId;
    }
    public static function isAlive(string $cacheId): bool
    {
        return file_exists(self::getFullPath($cacheId));
    }

    public static function get(string $cacheId): string
    {
        return file_get_contents(self::getFullPath($cacheId));
    }

    public static function set(string $cacheId, mixed $data): bool
    {
        $toPut = is_array($data) ? serialize($data) : $data;
        return file_put_contents(self::getFullPath($cacheId), $toPut) !== false;
    }

    public static function delete(string $cacheId): bool
    {
        return unlink(self::getFullPath($cacheId));
    }
}