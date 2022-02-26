<?php

namespace floor12\maps\models;

use app\models\query\MapQuery;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "map".
 *
 * @property int $id
 * @property int $created_at
 * @property int $updated_at
 * @property string $title
 * @property double $init_lat
 * @property double $init_lng
 * @property int $init_zoom
 * @property array $points
 * @property bool $draw_path [boolean]
 */
class Map extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'map';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['title'], 'required'],
            [['created_at', 'updated_at', 'init_zoom'], 'default', 'value' => null],
            [['init_zoom'], 'integer'],
            [['draw_path'], 'boolean'],
            [['init_lat', 'init_lng'], 'number'],
            [['points'], 'safe'],
            [['title'], 'string', 'max' => 255],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'title' => Yii::t('app', 'Title'),
            'init_lat' => Yii::t('app', 'Init latitude'),
            'init_lng' => Yii::t('app', 'Init longitude'),
            'init_zoom' => Yii::t('app', 'Init zoom value'),
            'points' => Yii::t('app', 'Points'),
            'draw_path' => Yii::t('app', 'Draw path'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return MapQuery the active query used by this AR class.
     */
    public static function find(): MapQuery
    {
        return new MapQuery(get_called_class());
    }

    public function behaviors(): array
    {
        return [
            'TimestampBehavior' => TimestampBehavior::class,
        ];
    }

    public function pointsForMap(): array
    {
        $points = [];
        foreach ($this->points as $point) {
            $points[] = [$point['lat'], $point['lng'], $point['title']];
        }
        return $points;
    }
}
