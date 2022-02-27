<?php
/**
 * @var $this yii\web\View
 * @var $model \floor12\maps\models\Map
 * @var $form yii\widgets\ActiveForm
 */

use floor12\editmodal\EditModalHelper;
use floor12\maps\assets\LeafLetAdminAsset;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

LeafLetAdminAsset::register($this);

$this->registerJs(sprintf('setTimeout(()=>{initMap(%s,%s,%s)},100)',
    $model->init_lat ?? '39.47218864054721',
    $model->init_lng ?? '-0.37535640210739485',
    $model->init_zoom ?? '15',
));

$form = ActiveForm::begin([
    'id' => 'modal-form',
    'options' => ['class' => 'modaledit-form'],
    'enableClientValidation' => true
]); ?>

    <div class='modal-header'>
        <div class="pull-right">
            <?= EditModalHelper::btnFullscreen(['class' => 'btn btn-xs btn-default']) ?>
            <?= EditModalHelper::btnClose(['class' => 'btn btn-xs btn-default']) ?>
        </div>
        <h2><?= Yii::t('maps', $model->isNewRecord ? 'Map creation' : 'Map update') ?></h2>
    </div>

    <div class='modal-body'>


        <div class="row">
            <div class="col-md-9">
                <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-3" style="padding-top: 25px">
                <?= $form->field($model, 'draw_path')->checkbox() ?>
            </div>
        </div>


        <div class="row">
            <div class="col-md-4">
                <?= $form->field($model, 'init_lat')->textInput() ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'init_lng')->textInput() ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'init_zoom')->textInput() ?>
            </div>
        </div>

        <div id="map"></div>


        <label>Точки маршрута</label>
        <ul id="map-point-list">
            <?php if ($model->points) foreach ($model->points as $key => $point) { ?>
                <li>
                    <div class="row">
                        <div class="col-md-3">
                            <input value="<?= $point['lat'] ?>" class="form-control"
                                   name="Map[points][<?= $key ?>][lat]">
                        </div>
                        <div class="col-md-3">
                            <input value="<?= $point['lng'] ?>" class="form-control"
                                   name="Map[points][<?= $key ?>][lng]">
                        </div>
                        <div class="col-md-5">
                            <input value="<?= $point['title'] ?? '' ?>" class="form-control map-point-name"
                                   name="Map[points][<?= $key ?>][title]">
                        </div>
                        <div class="col-md-1">
                            <button type="button" onclick="removePoint(event)" class="btn btn-xs">X</button>
                        </div>
                    </div>
                </li>
            <?php } ?>
        </ul>


    </div>

    <div class='modal-footer'>
        <?= Html::button(Yii::t('maps', 'Cancel'), ['class' => 'btn btn-default modaledit-disable']) ?>
        <?= Html::submitButton(Yii::t('maps', 'Save'), ['class' => 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end(); ?>