<?php

namespace App\Database\Query;

use App\Cache\Query\CacheItem;
use App\Container\Container;

class Query
{
    public function __construct(
        private $connection,
        private $cachedItem = null,
        private $query = ''
    ) {
        $this->connection = $connection->setup();
    }
    public function setQuery(string $query)
    {
        $this->query = $query;
    }

    public function getQuery()
    {
        return $this->query;
    }
    public function execute($fetch = true)
    {
        if ($this->query) {
            $result = $this->getCachedResult();
            if (!$result) {
                if ($fetch) {
                    $result = $this->connection->query($this->query)->fetchAll();
                } else {
                    $result = $this->connection->exec($this->query);
                }
                if ($this->cachedItem) {
                    $this->cachedItem->set($result);
                }
            }
            $this->query = null;
            return $result;
        }
    }

    private function getCachedResult()
    {
        $container = new Container();
        if ($container->has(CacheItem::class)) {
            $this->cachedItem = $container->get(CacheItem::class);
            $this->cachedItem = new CacheItem($this, new \App\Cache\System\Redis());
            $this->cachedItem->getKey();
            if ($this->cachedItem->isHit()) {
                return $this->cachedItem->get();
            }
        }
        return null;
    }
}
