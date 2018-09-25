<?php

namespace CampaigningBureau\FacebookRepository\Repositories\Caching;

use CampaigningBureau\FacebookRepository\Repositories\Contracts\FacebookRepository;
use Illuminate\Contracts\Cache\Repository as Cache;
use Illuminate\Support\Collection;

class CachingFacebookRepository implements FacebookRepository
{
    /**
     * @var FacebookRepository
     */
    private $repository;
    /**
     * @var Cache
     */
    private $cache;

    /**
     * CachingFacebookRepository constructor.
     *
     * @param FacebookRepository $repository
     * @param Cache              $cache
     */
    public function __construct(FacebookRepository $repository, Cache $cache)
    {
        $this->repository = $repository;
        $this->cache = $cache;
    }

    /**
     * loads the latest posts to the given limit from facebook and returns a cached collection of result objects.
     *
     * @param string $facebookPageName
     * @param int    $limit
     *
     * @return Collection|null
     */
    public function getLatestPosts($facebookPageName, $limit = 1)
    {
        $cacheKey = config('facebook-repository.caching.prefix') . '.latestPosts.' .
                    md5($facebookPageName . '.' . $limit);

        return $this->cache->remember($cacheKey, config('facebook-repository.caching.ttl', 60),
            function () use ($facebookPageName, $limit)
            {
                return $this->repository->getLatestPosts($facebookPageName, $limit);
            });
    }
}