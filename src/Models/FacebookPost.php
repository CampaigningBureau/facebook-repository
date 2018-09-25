<?php


namespace CampaigningBureau\FacebookRepository\Models;


use Carbon\Carbon;

class FacebookPost
{
    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $type;
    /**
     * @var string
     */
    private $message;
    /**
     * @var string
     */
    private $created_time;
    /**
     * @var string
     */
    private $picture;

    /**
     * FacebookPost constructor.
     *
     * @param string $id
     * @param string $type
     * @param string $message
     * @param string $created_time
     * @param string $picture
     */
    public function __construct($id, $type, $message, $created_time, $picture)
    {
        $this->id = $id;
        $this->type = $type;
        $this->message = $message;
        $this->created_time = $created_time;
        $this->picture = $picture;
    }

    /**
     * compute the difference from the creation time to now and return it as formatted string.
     * the formats for the day and the time part can be specified
     *
     * @param string $dayFormat
     * @param string $timeFormat
     *
     * @return string
     */
    public function getFormattedCreatedDate($dayFormat = 'd.m.Y', $timeFormat = 'H:i')
    {
        $created_at = Carbon::parse($this->created_time, config('app.timezone'));

        $day = date($dayFormat, strtotime($created_at));
        // special treatment for today and yesterday
        if (date('Y-m-d') == date('Y-m-d', strtotime($created_at))) {
            $day = trans('facebook-repository::messages.today');
        } elseif (date('Y-m-d', strtotime('yesterday')) == date('Y-m-d', strtotime($created_at))) {
            $day = trans('facebook-repository::messages.yesterday');
        }
        $time = date($timeFormat, strtotime($created_at));

        $stringDate = $day . ", " . $time;

        return $stringDate;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getCreatedTime(): string
    {
        return $this->created_time;
    }

    /**
     * returns the url of the picture
     *
     * @return string
     */
    public function getPicture(): string
    {
        return $this->picture;
    }

    /**
     * returns true if the facebook post has a picture
     * @return bool
     */
    public function hasPicture(): bool
    {
        return $this->picture !== null && trim($this->picture) !== '';
    }

    /**
     * returns true if the facebook post has a message
     * @return bool
     */
    public function hasMessage(): bool
    {
        return $this->message !== null && trim($this->message) !== '';
    }
}