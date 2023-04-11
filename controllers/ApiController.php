<?php


namespace app\controllers;


use app\models\Dish;
use app\models\Order;
use app\models\OrderDish;
use Yii;
use yii\base\Exception;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\rest\Controller;
use yii\web\Response;

class ApiController extends Controller
{

    public function beforeAction($action)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return parent::beforeAction($action);
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'create-order' => ['post'],
                    'add-order-dish' => ['post'],
                    'popular-cooks' => ['get'],
                ],
            ],
        ];
    }

    public function actionCreateOrder()
    {
        $model = new Order();
        if ($model->load(Yii::$app->request->post(), '') && $model->save()) {
            return [
                'success' => true,
                'order' => $model->attributes
            ];
        }
        return [
            'success' => false,
            'errors' => $model->getErrors()
        ];
    }

    public function actionAddOrderDish()
    {
        $model = new OrderDish();
        if ($model->load(Yii::$app->request->post(), '') && $model->save()) {
            return [
                'success' => true,
                'orderDish' => $model->attributes
            ];
        }
        return [
            'success' => false,
            'errors' => $model->getErrors()
        ];
    }

    public function actionPopularCooks(string $start = null, string $end = null)
    {
        return Dish::getPopularCooks(strtotime($start), strtotime($end));
    }

}