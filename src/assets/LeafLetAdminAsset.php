<?php

namespace floor12\maps\assets;


use yii\web\AssetBundle;

class LeafLetAdminAsset extends AssetBundle
{
    public $sourcePath = '@vendor/floor12/yii2-open-maps/assets/';

    public $css = [
        'leaflet.css',
    ];
    public $js = [
        'leaflet.js',
        'map.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset'
    ];
}
