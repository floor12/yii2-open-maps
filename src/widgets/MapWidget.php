<?php

namespace floor12\maps\widgets;

use floor12\maps\models\Map;
use yii\base\Widget;

class MapWidget extends Widget
{
    public ?Map $map = null;

    public function run(): string
    {
        if (!$this->map) {
            return '';
        }
        return SimpleMapWidget::widget([
            'id' => 'map',
            'drawLines' => $this->map->draw_path,
            'init_zoom' => $this->map->init_zoom,
            'init_lat' => $this->map->init_lat,
            'init_lng' => $this->map->init_lng,
            'points' => $this->map->pointsForMap()
        ]);
    }
}