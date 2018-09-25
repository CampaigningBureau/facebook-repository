<?php


namespace CampaigningBureau\FacebookRepository\Factories;


use CampaigningBureau\FacebookRepository\Models\FacebookPost;

class FacebookPostFactory
{
    /**
     * builds a new facebook post model of the array retrieved from facebook
     * @param array $postData
     *
     * @return FacebookPost
     */
    public static function build(array $postData)
    {

        return new FacebookPost(
            $postData['id'],
            $postData['type'],
            array_key_exists('message', $postData) ? $postData['message'] : '',
            $postData['created_time'],
            array_key_exists('full_picture', $postData) ? $postData['full_picture'] : null
        );
    }
}