<?php

namespace floor12\maps\models;


use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[\app\models\entity\Map]].
 *
 * @see \app\models\entity\Map
 */
class MapQuery extends ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return Map[]|array
     */
    public function all($db = null): array
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Map|array|null
     */
    public function one($db = null): array|Map|null
    {
        return parent::one($db);
    }

    public function dropdown(): array
    {
        return $this
            ->select('title')
            ->indexBy('id')
            ->orderBy('title')
            ->column();
    }
}
