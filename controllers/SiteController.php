<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
//use app\models\LoginForm;
//use app\models\RegForm;
use app\models\ContactForm;
//use app\models\User;
//use app\models\Profile;

class SiteController extends Controller
{
    
    public $defaultAction = 'index';
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
//    public function actionReg()
//    {
//        $model = new RegForm();
// 
//         if ($model->load(Yii::$app->request->post()) && $model->validate()):           
//            if ($user = $model->reg()):
//                if ($user->status === User::STATUS_ACTIVE):
//                    if (Yii::$app->getUser()->login($user)):
//                        return $this->goHome();
//                    endif;
//            endif;
//             else:
//                 Yii::$app->session->setFlash('error', 'Трапилась халепа. Не можу зарегіструвати.');
//                 Yii::error('Помилка при регістрації');
//                 return $this->refresh();
//             endif;
//         endif;
// 
//         return $this->render(
//             'reg',
//             [
//                 'model' => $model
//             ]
//         );
//    }

//    public function actionLogin()
//    {
//        if (!Yii::$app->user->isGuest):
//            return $this->goHome();
//        endif;
//        $model = new LoginForm();
//        if ($model->load(Yii::$app->request->post()) && $model->login()):
//            return $this->goBack();
//        endif;
//        return $this->render(
//            'login',
//            [
//                'model' => $model
//            ]
//        );
//    }

    /**
     * Logout action.
     *
     * @return string
     */
//    public function actionLogout()
//    {
//        Yii::$app->user->logout();
//
//        return $this->goHome();
//    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    
//    public function actionProfile(){
//        $model=($model= Profile::findOne(Yii::$app->user->id))?$model:new Profile();
//        
//        if($model->load(Yii::$app->request->post()) && $model->validate()):
//            if($model->updateProfile()):
//                Yii::$app->session->setFlash('success', 'Профіль змінено');
//            else:
//                Yii::$app->session->setFlash('error', 'Профіль не змінено');
//                Yii::error('Помилка запису. Профіль не змінено');
//                return $this->refresh();
//            endif;
//        endif;
//        return $this->render(
//            'profile',
//            [
//                'model' => $model
//            ]
//        );
//    }
}
