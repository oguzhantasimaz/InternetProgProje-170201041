<?php
namespace kouosl\notetaking\controllers\api;


class DefaultController extends \kouosl\base\controllers\api\BaseController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return ['status' => '404','message' => 'Not Found'];
    }
}
