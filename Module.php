<?php
namespace kouosl\notetaking;

use Yii;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\web\HttpException;


class Module extends \kouosl\base\Module
{
    //public $controllerNamespace = 'kouosl\notetaking\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        switch ($this->namespace)
        {
            case 'backend':{

            };break;
            case 'frontend':{

            };break;
            case 'api':{

                $behaviors['authenticator'] = [
                    'class' => CompositeAuth::className(),
                    'authMethods' => [
                        HttpBasicAuth::className(),
                        HttpBearerAuth::className(),
                        QueryParamAuth::className(),
                    ],
                ];
            };break;
            case 'console':{

            };break;
            default:{
                throw new HttpException(500,'behaviors'.$this->namespace);
            };break;
        }

        return $behaviors;

    }

    public function registerTranslations()
    {
        Yii::$app->i18n->translations['notetaking/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@kouosl/notetaking/messages',
            'fileMap' => [
                'notetaking/notetaking' => 'notetaking.php',
            ],
        ];
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        Yii::$app->i18n->translations['notetaking/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@kouosl/notetaking/messages',
            'fileMap' => [
                'notetaking/notetaking' => 'notetaking.php',
            ],
        ];
        return Yii::t('notetaking/'. $category, $message, $params, $language);
    }
 
    public static function initRules(){

        return $rules = [
            [
                'class' => 'yii\rest\UrlRule',
                'controller' => [
                   'notetaking/notetakings',
                ],
                'tokens' => [
                    '{id}' => '<id:\\w+>'
                ],
                /*'patterns' => [
                    'GET new-action' => 'new-action'
                ]*/
            ],

        ] ;

    }
}
