<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

class FileAccessController extends Controller
{
    public function actionAccessFile($filepath)
    {
        if (strpos($filepath,'vacancy_responces')){
            if (Yii::$app->user->isGuest) {
                throw new ForbiddenHttpException("Доступно только авторизованным пользователям. Пожалуйста войдите");
            }
            if (Yii::$app->user->identity->is_manager) {
                if (is_file($filepath) && is_readable($filepath)) {
                    return Yii::$app->response->sendFile($filepath);
                } else {
                    throw new NotFoundHttpException('Запрашеваемый файл не доступен.');
                }
            } else {
                throw new ForbiddenHttpException('У вас нет доступа к этому ресурсу');
            }
        }
        else{
            if (is_file($filepath) && is_readable($filepath)) {
                return Yii::$app->response->sendFile($filepath);
            } else {
                throw new NotFoundHttpException('Запрашиваемый файл не доступен.');
            }
        }
    }
}
