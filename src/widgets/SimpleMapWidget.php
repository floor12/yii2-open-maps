<?php

namespace floor12\maps\widgets;

use floor12\maps\assets\LeafLetPublicAppAsset;
use Yii;
use yii\base\Widget;
use yii\helpers\Html;

class SimpleMapWidget extends Widget
{
    public array $points = [];
    public ?float $init_lat = null;
    public ?float $init_lng = null;
    public ?int $init_zoom = 14;
    public string $id = 'map';
    public bool $drawLines = false;
    public bool $makeHtml = true;

    public function init()
    {
        Yii::$app->getModule('maps');
        parent::init();
    }

    public function run(): string
    {
        if (!$this->init_lat || !$this->init_lng) {
            return '';
        }

        LeafLetPublicAppAsset::register(\Yii::$app->getView());

        \Yii::$app->getView()->registerJs(sprintf('initMap(%s,%s,%s,%s)',
            $this->id,
            $this->init_lat,
            $this->init_lng,
            $this->init_zoom,
        ));

        \Yii::$app->getView()->registerJs(sprintf('drawPoints(%s, %s)',
            json_encode($this->points),
            $this->drawLines
        ));

        if ($this->makeHtml) {
            return Html::tag('div', '', ['id' => 'map']) .
                Html::button(Yii::t('maps', 'Switch map mode'), [
                    'type' => 'button',
                    'class'=>'openmap-mode-swither',
                    'onclick' => 'mapSwitchMode();'
                ]);
        }
        return '';
    }
}