<?php

namespace floor12\maps;

use Yii;

/**
 * pages module definition class
 * @property  string $administratorRoleName
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'floor12\maps\controllers';

    /**
     * Те роли в системе, которым разрешено редактирование новостей
     * @var array
     */
    public $administratorRoleName = '@';

    /** Лейаут для контроллера
     * @var string
     */
    public $adminLayout = '@app/views/layouts/main';

    public function adminMode()
    {
        if ($this->administratorRoleName == '@')
            return !\Yii::$app->user->isGuest;
        else
            return \Yii::$app->user->can($this->administratorRoleName);
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
        $i18n->translations['maps'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@vendor/floor12/yii2-open-maps/src/messages',
        ];
    }
}
