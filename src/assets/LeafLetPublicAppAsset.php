<?php

namespace floor12\maps\assets;


use yii\web\AssetBundle;

class LeafLetPublicAppAsset extends AssetBundle
{
    public $sourcePath = '@vendor/floor12/yii2-open-maps/assets/';

    public $css = [
        'leaflet.css',
    ];
    public $js = [
        'leaflet.js',
        'map-pub.js',
    ];

}
