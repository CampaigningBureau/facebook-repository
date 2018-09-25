<?php


namespace CampaigningBureau\FacebookRepository\Repositories;


use CampaigningBureau\FacebookRepository\Exceptions\FacebookRepositoryException;
use CampaigningBureau\FacebookRepository\Factories\FacebookPostFactory;
use CampaigningBureau\FacebookRepository\Repositories\Contracts\FacebookRepository;
use Facebook\Exceptions\FacebookSDKException;
use Illuminate\Support\Collection;
use SammyK\LaravelFacebookSdk\LaravelFacebookSdk;

class ConcreteFacebookRepository implements FacebookRepository
{

    /**
     * loads the latest posts to the given limit from facebook and returns a collection of result objects
     *
     * @param int $limit
     *
     * @return Collection|null
     * @throws FacebookRepositoryException
     */
    public function getLatestPosts($facebookPageName, $limit = 1)
    {
        $facebook = app(LaravelFacebookSdk::class);

        try {
            $response =
                $facebook->get('/' . $facebookPageName . '/feed?fields=message,type,created_time,full_picture&limit=' .
                               $limit,
                    config('facebook-repository.facebook_app_id') . '|' .
                    config('facebook-repository.facebook_app_secret'));
        } catch (FacebookSDKException $fse) {
            throw new FacebookRepositoryException($fse);
        }

        $posts = $response->getDecodedBody();

        if (!array_key_exists('data', $posts)) {
            throw new FacebookRepositoryException('Did not receive a valid response from Facebook: ' .
                                                  serialize($response->getDeocedBody()));
        }

        $facebookPosts = new Collection();
        foreach ($posts['data'] as $post) {
            $facebookPosts->push(FacebookPostFactory::build($post));
        }

        return $facebookPosts;
    }
}