<?php

namespace floor12\maps;

/**
 * pages module definition class
 * @property  string $editRole
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'floor12\maps\contollers';

    /**
     * Те роли в системе, которым разрешено редактирование новостей
     * @var array
     */
    public $editRole = '@';

    /** Лейаут для контроллера
     * @var string
     */
    public $layout = '@app/views/layouts/main';

    public function adminMode()
    {
        if ($this->editRole == '@')
            return !\Yii::$app->user->isGuest;
        else
            return \Yii::$app->user->can($this->editRole);
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->registerTranslations();
        parent::init();
    }


    /**
     * @return void
     */
    public function registerTranslations()
    {
        $i18n = Yii::$app->i18n;
        $i18n->translations['files'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@vendor/floor12/maps/src/messages',
        ];
    }
}
