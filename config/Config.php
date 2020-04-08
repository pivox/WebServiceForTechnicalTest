<?php
namespace Webserver\Config;

final class Config
{
    private static $base_url = "nginx";
    private static $url = "/api/question/";
    private static $url_id = "{id}";

    public static function getQuestionsUrl()
    {
        return self::$base_url.self::$url;
    }

    public static function editQuestionUrl(int $id)
    {

        return self::$base_url.str_replace('{id}', $id, self::$url_id);
    }

    public static function getQuestionUrl(int $id)
    {
        return self::$base_url.self::$url.str_replace('{id}', $id, self::$url_id);
    }
}