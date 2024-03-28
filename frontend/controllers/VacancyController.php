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
    
        public function actionCreateVacancy()
        {
            $model = new CreateVacancyForm();
        
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                $vacancy = new Vacancy();
                $vacancy->position_name = $model->position_name;
                $vacancy->description = $model->description;
                $vacancy->salary = $model->salary;
                $vacancy->requirements = $model->requirements;
                $vacancy->responsibilities = $model->responsibilities;
                $vacancy->work_schedule = $model->work_schedule;
                $vacancy->academic_direction = $model->academic_direction;
                $vacancy->location = $model->location;
                $vacancy->contact_info = $model->contact_info;
                $vacancy->publication_date = $model->publication_date;
                $vacancy->application_deadline = $model->application_deadline;
                $vacancy->is_active = $model->is_active;
                $vacancy->company = $model->company;
        
                if ($vacancy->save()) {
                    Yii::$app->session->setFlash('success', 'Вакансия успешно создана.');
                    return $this->redirect(['detail', 'id' => $vacancy->id]); // Предполагается, что есть действие view для отображения деталей вакансии
                } else {
                    Yii::$app->session->setFlash('error', 'Произошла ошибка при сохранении вакансии.');
                }
            }
        
            return $this->render('createVacancy', [
                'model' => $model,
            ]);
        }

        public function actionEditVacancy($id)
        {
            $vacancy = Vacancy::findOne($id);
            if ($vacancy === null) {
                throw new NotFoundHttpException('Вакансия не найдена.'); // Обработка случая, когда вакансия с указанным идентификатором не найдена
            }

            $formModel = new CreateVacancyForm();
            $formModel->attributes = $vacancy->attributes; // Заполняем атрибуты модели формы значениями из модели вакансии

            if ($formModel->load(Yii::$app->request->post()) && $formModel->validate()) { // Загружаем данные из формы и валидируем модель формы
                // Обновляем атрибуты модели вакансии значениями из модели формы
                $vacancy->attributes = $formModel->attributes;
                if ($vacancy->save()) { // Сохраняем модель вакансии
                    Yii::$app->session->setFlash('success', 'Вакансия успешно отредактирована.');
                    return $this->redirect(['detail', 'id' => $vacancy->id]);
                }
            }

            return $this->render('editVacancy', [
                'model' => $formModel,
            ]);
        }
        //maybe to ResponseController
        public function actionResponses()
        {
            $dataProvider = new ActiveDataProvider([
                'query' => VacancyResponse::find(),
                'pagination' => [
                    'pageSize' => 10, // Укажите количество элементов на странице
                ],
            ]);

            return $this->render('responses', [
                'dataProvider' => $dataProvider,
            ]);
        }




    
}
