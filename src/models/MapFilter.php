<?php

namespace floor12\maps\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\web\BadRequestHttpException;


class MapFilter extends Model

{
    public $filter;
    public $status;

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            ['filter', 'string'],
            ['status', 'integer']
        ];
    }


    /**
     * @throws BadRequestHttpException
     */
    public function dataProvider(): ActiveDataProvider
    {
        if (!$this->validate()) {
            throw new BadRequestHttpException('Form validation error.');
        }

        $query = Map::find();

//        $query->andFilterWhere(['=', 'status', $this->status]);
//        $query->andFilterWhere(['ILIKE', 'name', is_numeric($this->filter) ? NULL : $this->filter]);
//        $query->andFilterWhere(['=', 'id', is_numeric($this->filter) ? (int)$this->filter : NULL]);

        return new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
        ]);
    }

}
