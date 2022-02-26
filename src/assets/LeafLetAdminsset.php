<?php

namespace floor12\maps\models;


use yii\web\AssetBundle;

class LeafLetAdminsset extends AssetBundle
{
    public $sourcePath = '@vendor/floor12/yii2-open-maps/assets/';

    public $css = [
        'css/leaflet.css',
    ];
    public $js = [
        'js/leaflet.js',
        'js/map.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset'
    ];
}
