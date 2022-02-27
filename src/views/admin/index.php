<?php
/**
 * @var $this yii\web\View
 * @var $model \floor12\maps\models\Map
 */

use floor12\editmodal\EditModalColumn;
use floor12\editmodal\EditModalHelper;
use floor12\editmodal\IconHelper;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

$this->title = Yii::t('maps', 'Maps');
$this->params['breadcrumbs'][] = $this->title;

echo EditModalHelper::editBtn('form', 0, 'btn btn-primary btn-sm pull-right', IconHelper::PLUS . ' ' . Yii::t('maps', 'Create map'));

?>

    <h1><?= $this->title ?></h1>

<?php $form = ActiveForm::begin([
    'method' => 'GET',
    'options' => ['class' => 'autosubmit', 'data-container' => '#items'],
    'enableClientValidation' => false,
]); ?>

    <div class="filter-block">
        <div class="row">
            <div class="col-md-9">
                <?= $form->field($model, 'filter')->label(false)->textInput(['placeholder' => 'Поиск', 'autofocus' => true]) ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'status')->label(false)->dropDownList([], ['prompt' => 'Все статусы']) ?>
            </div>
        </div>
    </div>

<?php

ActiveForm::end();

Pjax::begin([
    'id' => 'items',
    'scrollTo' => true,
]);

echo GridView::widget([
    'dataProvider' => $model->dataProvider(),
    'layout' => '{items}{pager}{summary}',
    'tableOptions' => ['class' => 'table table-striped'],
    'columns' => [
        'id',
        'title',
        [
            'class' => EditModalColumn::class,
        ],
    ],
]);

Pjax::end();
