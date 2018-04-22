<?php

namespace app\components;

use Yii;
use yii\base\Component;
use GuzzleHttp\Client;
 
class Translator extends Component
{
    private $client;
    private $key = '?key=trnsl.1.1.20180422T172304Z.9e6056c6d74a3a25.7ff57f392c4b206a2094d2e49d730de8de0b0cf1';

    public function __construct() {
        $this->client = new Client;
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