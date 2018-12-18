<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\LoginForm;
use common\models\SignupForm;

class AuthController extends Controller
{

  public function actionLogin()
  {
       if (!Yii::$app->user->isGuest) {
           return $this->goHome();
       }
       $model = new LoginForm();
       if ($model->load(Yii::$app->request->post()) && $model->login()) {
           return $this->goBack();
       }
       return $this->render('login', [
           'model' => $model,
       ]);
   }

   public function actionLogout()
   {
       Yii::$app->user->logout();
       return $this->goHome();
   }

   public function actionSignup()
   {
       $model = new SignupForm();
       if(Yii::$app->request->isPost)
       {
           $model->load(Yii::$app->request->post());
           if($model->signup())
           {
               return $this->redirect(['auth/login']);
           }
       }
       return $this->render('signup', ['model'=>$model]);
   }
}
