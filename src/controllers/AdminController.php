<?php

namespace floor12\maps\controllers;


use floor12\editmodal\DeleteAction;
use floor12\editmodal\EditModalAction;
use floor12\editmodal\IndexAction;
use floor12\maps\models\MapFilter;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use floor12\maps\models\Map;


class AdminController extends Controller
{


    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => [Yii::$app->getModule('maps')->administratorRoleName],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['delete'],
                    'approve' => ['post'],
                ],
            ],
        ];
    }


    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->layout = Yii::$app->getModule('maps')->adminLayout;
        parent::init();
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
