<?php

namespace app\components;

use Yii;
use yii\bootstrap\ButtonDropdown;
use yii\helpers\Url;
use yii\jui\Widget;
use yii\web\Cookie;

/*
  author :: Pitt Phunsanit
  website :: http://plusmagi.com
  change language by get language=EN, language=TH,...
  or select on this widget
 */

class LanguageSwitcher extends Widget {

    const DEFAULT_LANGUAGE = "ar-AR";

    public $languages;

    public static function getLanguages() {
        return [
            'en-US' => Yii::t('language', 'English (US)'),
            'ar-AR' => Yii::t('language', 'Arabic')
        ];
    }

    public static function isRtl() {
        if (Yii::$app->language == self::DEFAULT_LANGUAGE) {
            return TRUE;
        }
        return FALSE;
    }

    public function init() {
        $this->languages = self::getLanguages();
        if (php_sapi_name() === 'cli') {
            return true;
        }

        parent::init();

        $cookies = Yii::$app->response->cookies;
        $languageNew = Yii::$app->request->get('language');
        if ($languageNew) {
            if (isset($this->languages[$languageNew])) {
                Yii::$app->language = $languageNew;
                $cookies->add(new Cookie([
                    'name' => 'language',
                    'value' => $languageNew
                ]));
            }
        } else {
            $cookies = Yii::$app->request->cookies;
            if ($cookies->has('language')) {
                Yii::$app->language = $cookies->getValue('language');
            } else {
                Yii::$app->language = $this::DEFAULT_LANGUAGE;
            }
        }
    }

    public function run() {
        $languages = $this->languages;
        $current = $languages[Yii::$app->language];
        unset($languages[Yii::$app->language]);

        $items = [];
        foreach ($languages as $code => $language) {
            $temp = [];
            $temp['label'] = $language;
            $temp['url'] = Url::current(['language' => $code]);
            array_push($items, $temp);
        }

        echo ButtonDropdown::widget([
            'label' => $current,
            'dropdown' => [
                'items' => $items,
            ],
            'options' => [
                'style' => 'margin:8px'
            ],
        ]);
    }

}
