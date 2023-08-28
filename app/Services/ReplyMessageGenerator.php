<?php

namespace App\Services;

class ReplyMessageGenerator {
    private $weatherForecaster;

    public function __construct(WeatherForecaster $weatherForecaster = null)
    {
        $this->weatherForecaster = $weatherForecaster;
    }

    public function generate($text)
    {
        switch ($text) {
            case '今日の天気は？':
                // 天気APIを使って情報を取得してきたら正しい情報にできる
                $replyMessage = $this->generateWeatherForecast();
                break;
            case '教育':
                $replyMessage = '大変申し訳御座いません。
厳しく改善指導致します。';
                break;
            case '死刑':
                $replyMessage = '大変申し訳御座いません。
即指導致します。';
                break;
            case '教育死刑':
                $replyMessage = '大変申し訳御座いません。
指導徹底致します。';
                break;
            case '死刑教育':
                $replyMessage = '大変申し訳御座いません。
指導徹底致します。';
                break;
            default:
                if (strpos($text, '？') !== false) {
                    // 疑問符が含まれている場合(部分一致)
                    $replyMessage = '「今日の天気は？」という質問に答える事ができますよ！';
                } else {
                    $replyMessage = '教育教育教育教育教育教育教育教
育教育教育教育教育教育教育教育
教育教育教育死刑死刑死刑死刑死
刑死刑死刑死刑死刑教育教育教育
教育教育教育教育教育教育教育教
育教育教育教育教育教育教育教育';
                }
        }

        return $replyMessage;
    }
    
    private function generateWeatherForecast()
    {
        if (!$this->weatherForecaster) {
            return 'は、晴れかな・・・（しらんけど）';
        }

        $replyMessage = $this->weatherForecaster->forecast();
        if (!$replyMessage) {
            $replyMessage = '天気情報を取得できませんでした。懲りずにまた明日聞いてください(´ . .̫ . `)';
        }

        return $replyMessage;
    }
}