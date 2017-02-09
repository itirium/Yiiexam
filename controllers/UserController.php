<?php

namespace app\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\RegForm;
use app\models\Profile;
use app\models\User;

class UserController extends Controller
{
    public function actionLogin()
    {
       if (!Yii::$app->user->isGuest):
            return $this->goHome();
        endif;
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()):
            return $this->goBack();
        endif;
        return $this->render(
            'login',
            [
                'model' => $model
            ]
        );
    }
    
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    
    public function actionReg()
    {
        $model = new RegForm();
 
         if ($model->load(Yii::$app->request->post()) && $model->validate()):           
            if ($user = $model->reg()):
                if ($user->status === User::STATUS_ACTIVE):
                    if (Yii::$app->getUser()->login($user)):
                        return $this->goHome();
                    endif;
            endif;
             else:
                 Yii::$app->session->setFlash('error', 'Трапилась халепа. Не можу зарегіструвати.');
                 Yii::error('Помилка при регістрації');
                 return $this->refresh();
             endif;
         endif;
 
         return $this->render(
             'reg',
             [
                 'model' => $model
             ]
         );
    }
    
    public function actionProfile(){
        $model=($model= Profile::findOne(Yii::$app->user->id))?$model:new Profile();
        
        if($model->load(Yii::$app->request->post()) && $model->validate()):
            if($model->updateProfile()):
                Yii::$app->session->setFlash('success', 'Профіль змінено');
            else:
                Yii::$app->session->setFlash('error', 'Профіль не змінено');
                Yii::error('Помилка запису. Профіль не змінено');
                return $this->refresh();
            endif;
        endif;
        return $this->render(
            'profile',
            [
                'model' => $model
            ]
        );
    }
    
    public function  actionManagers(){
   
    
        
    $action=Yii::$app->request->post('action');
    $selection=(array)Yii::$app->request->post('selection');//typecasting
    foreach($selection as $id){
        $e=User::findOne((int)$id);//make a typecasting
        $e->ismanager=$action;
        $e->save();
    }
        return $this->render('managers');
    }
    
    public function actionMan(){
    $action=Yii::$app->request->post('action');
    $selection=(array)Yii::$app->request->post('selection');//typecasting
    foreach($selection as $id){
        $e=Evento::findOne((int)$id);//make a typecasting
        //do your stuff
        $e->save();
    }
    }
    

}
