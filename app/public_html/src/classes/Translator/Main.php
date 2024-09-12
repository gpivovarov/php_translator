<?php
namespace Translator;

use \Cache\File as FileCache;
use \Database\TranslateTable;

class Main extends ABSTranslator
{
    /**
     * Gets translate from database using file caching
     * @param string $text - source text
     * @return string - translated or original text
     */
    public function getTranslate(string $text): string {
        $data = [
            'src' => $this->fromLang,
            'dst' => $this->toLang,
            'text' => $text
        ];
        $cacheId = FileCache::getCacheId($data);
        if (FileCache::isAlive($cacheId)) {
            return FileCache::get($cacheId) ?: '';
        }

        $dbHandle = new TranslateTable();
        $row = false;
        try {
            $row = $dbHandle->getRow([$this->fromLang => $text], [$this->toLang]);
        } catch (\Exception $exception) {
            print_r($exception->getMessage());
            return $text;
        }

        if ($row) {
            FileCache::set($cacheId, $row[$this->toLang]);
            return $row[$this->toLang];
        }

        return $text;

    }
}