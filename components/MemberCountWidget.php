<?php 

   namespace kouosl\notetaking\components; 
    use Yii;
    use yii\base\Widget;
    use yii\helpers\Html;
    use kouosl\notetaking\models\User;
    use kouosl\notetaking\Module;
    //todo
   class MemberCountWidget extends Widget { 
      public $count; 

      public function init() { 
         parent::init(); 
         
         $count=User::find()->count(); 
         
      }  
      public function run() { 
    

         return   Module::t('notetaking', 'Total number of members on our site : ').User::find()->count();
      } 
   } 
   ?>

   