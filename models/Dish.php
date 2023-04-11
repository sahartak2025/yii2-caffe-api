<?php

namespace app\models;

use Yii;
use yii\db\Expression;

/**
 * This is the model class for table "dishes".
 *
 * @property int $id
 * @property string $name
 * @property string $cook
 *
 * @property OrderDish[] $orderDishes
 */
class Dish extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dishes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'cook', 'price'], 'required'],
            [['price'], 'number'],
            [['name', 'cook'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'cook' => 'Cook',
        ];
    }

    /**
     * Gets query for [[OrderDishes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrderDishes()
    {
        return $this->hasMany(OrderDish::class, ['dish_id' => 'id']);
    }

    public static function getPopularCooks(int $startTime, int $endTime): array
    {
        return OrderDish::find()
            ->select([
                Dish::tableName() . '.cook',
                new Expression('SUM(quantity) as total_sum'),
            ])
            ->innerJoinWith('dish', false)
            ->innerJoinWith('order', false)
            ->andWhere(['BETWEEN', Order::tableName() . '.created_at', $startTime, $endTime])
            ->groupBy('dish_id')
            ->asArray()
            ->all();
    }
}
