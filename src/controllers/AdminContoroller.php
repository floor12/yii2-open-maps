<?php

namespace app\modules\admin\controllers;


use app\models\entity\Map;
use app\models\filter\MapFilter;
use yii\web\Controller;
use floor12\editmodal\DeleteAction;
use floor12\editmodal\EditModalAction;
use floor12\editmodal\IndexAction;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;


class AdminContoroller extends Controller
{

    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'index' => ['GET'],
                    'form' => ['GET', 'POST'],
                    'delete' => ['DELETE'],
                ],
            ],
        ];
    }


    public function actions(): array
    {
        return [
            'index' => [
                'class' => IndexAction::class,
                'model' => MapFilter::class,
            ],
            'form' => [
                'class' => EditModalAction::class,
                'model' => Map::class,
                'message' => 'Объект сохранен'
            ],
            'delete' => [
                'class' => DeleteAction::class,
                'model' => Map::class,
                'message' => 'Объект удален'
            ],
        ];
    }


}
