<?php

namespace frontend\controllers;


use Yii;
use frontend\models\VacancyResponseForm;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Vacancy;
use common\models\VacancyResponse;
use frontend\models\CreateVacancyForm;
use yii\data\ActiveDataProvider;

use yii\web\UploadedFile;



/**
 * Site controller
 */
class PpsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'signup','create-vacancy','edit-vacancy','responses'], // добавляем ваше действие
                'rules' => [
                    [
                        'actions' => ['create-vacancy','edit-vacancy','responses'], // определяем действие
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                            if (Yii::$app->user->isGuest || Yii::$app->user->identity->is_manager === false) {
                                throw new \yii\web\ForbiddenHttpException('Доступ запрещен');
                            }
                            return true;
                        },
                    ],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
            'captcha' => [
                'class' => \yii\captcha\CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    public function actionPps()
    {
        
        $vacancy_list = Vacancy::find()
            ->orderBy(['is_active' => SORT_DESC, 'publication_date' => SORT_DESC])
            ->all();

        return $this->render('pps', [
            'vacancy' => $vacancy_list,
        ]);
    }

    




    
}
