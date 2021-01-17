<?php
namespace kouosl\notetaking\controllers\frontend;
use kouosl\notetaking\models\NotetakingNotesSearch;
use Yii;
class TableController extends \kouosl\base\controllers\frontend\BaseController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
       

        return $this->render('test');
    }
}
