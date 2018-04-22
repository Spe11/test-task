<?php

namespace app\components;

use Yii;
use yii\base\Component;
use GuzzleHttp\Client;
 
class Translator extends Component
{
    private $client;
    private $key;

    public function __construct() {
        $this->client = new Client;
        $this->key = '?key='.Yii::$app->params['key'];
    }

    public function toEng($from, $text) {
        return $this->translate($from, 'en', $text);
    }

    public function toCustom($to, $text) {
        return $this->translate('en', $to, $text);
    }

    public function languages() {
        $res = $this->client->request('GET',
            'https://translate.yandex.net/api/v1.5/tr.json/getLangs'.$this->key.'&ui=en');
        return json_decode($res->getBody())->langs;
    }

    private function translate($from, $to, $text) {
        $res = $this->client->request('POST',
            'https://translate.yandex.net/api/v1.5/tr.json/translate'.
                $this->key.'&text='.$text.'&lang='.$from.'-'.$to, [
            'headers' => ['Content-Type' => 'application/x-www-form-urlencoded'],
        ]);
        return current(json_decode($res->getBody())->text);
    }
}