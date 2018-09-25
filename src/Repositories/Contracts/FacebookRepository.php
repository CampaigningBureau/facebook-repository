<?php


namespace CampaigningBureau\FacebookRepository\Repositories\Contracts;


use Illuminate\Support\Collection;

interface FacebookRepository
{
    /**
     * loads the latest posts to the given limit from facebook and returns a collection of result objects
     *
     * @param string $facebookPageName
     * @param int    $limit
     *
     * @return Collection|null
     */
    public function getLatestPosts($facebookPageName, $limit = 1);
}