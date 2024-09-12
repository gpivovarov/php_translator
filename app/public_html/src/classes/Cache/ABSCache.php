<?php
namespace Cache;

abstract class ABSCache
{
    /**
     * Get unique cache identifier
     * @param array $params
     * @return string
     */
    public static function getCacheId(array $params): string
    {
        return sha1(serialize($params));
    }

    /**
     * Checks saved data is alive
     * @param string $cacheId
     * @return void
     */
    public static function isAlive(string $cacheId) { }

    /**
     * The value getter
     * @param string $cacheId
     * @return void
     */
    public static function get(string $cacheId) { }

    /**
     * The value setter
     * @param string $cacheId
     * @return void
     */
    public static function set(string $cacheId, mixed $data) { }


    /**
     * The value remover
     * @param string $cacheId
     * @return void
     */
    public static function delete(string $cacheId) { }
}
