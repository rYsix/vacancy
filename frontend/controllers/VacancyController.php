<?php

namespace frontend\controllers;


use Yii;
use frontend\models\VacancyResponseForm;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Vacancy;
use common\models\VacancyResponse;


use yii\web\UploadedFile;



/**
 * Site controller
 */
class VacancyController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
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

    public function actionDetail($id)
        {
            $vacancy = Vacancy::find()->where(['id' => $id])->one();

            if ($vacancy === null) {
                throw new \yii\web\NotFoundHttpException('The requested page does not exist.');
            }

            $model = new VacancyResponseForm();

            if ($model->load(Yii::$app->request->post())) {
                $model->attachment_file = UploadedFile::getInstance($model, 'attachment_file');
            
                // Вызываем функцию upload() и сохраняем возвращенный путь
                $uploadedFilePath = $model->upload($id);
            
                // Ваш код для сохранения данных из формы в базу данных
                $response = new VacancyResponse();
                $response->vacancy_id = $id;
                $response->full_name = $model->full_name;
                $response->about = $model->about;
                $response->email = $model->email;
            
                // Проверяем, был ли возвращен путь
                if ($uploadedFilePath !== null) {
                    // Если путь был возвращен, сохраняем его
                    $response->attachment_path = $uploadedFilePath;
                }
            
                // Сохраняем запись в базу данных
                $response->save();
            
                Yii::$app->session->setFlash('success', 'Ваш отклик успешно отправлен.');
                return $this->refresh(); 
            }
            

            return $this->render('detail', [
                'vacancy' => $vacancy,
                'model' => $model,
            ]);
        }

    
}
