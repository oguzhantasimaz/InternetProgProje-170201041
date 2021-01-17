<?php
namespace kouosl\notetaking\controllers\console;


use Yii;
use yii\console\Controller;
//use
class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();
        
    
        $createNote = $auth->createPermission('createNote');
        $createNote->description = 'Create a note';
        $auth->add($createNote);

        $updateNote = $auth->createPermission('updateNote');
        $updateNote->description = 'Update note';
        $auth->add($updateNote);

        $deleteNote = $auth->createPermission('deleteNote');
        $deleteNote->description = 'Delete note';
        $auth->add($deleteNote);

        $seeAllNotes = $auth->createPermission('seeAllNotes');
        $seeAllNotes->description = 'See All Notes';
        $auth->add($seeAllNotes);



        $user = $auth->createRole('user');
        $auth->add($user);
        $auth->addChild($user, $createNote);
        $auth->addChild($user, $updateNote);
        $auth->addChild($user, $deleteNote);
    
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $seeAllNotes);
        $auth->addChild($admin, $user);
        
        $auth->assign($admin, 1);
    }
}