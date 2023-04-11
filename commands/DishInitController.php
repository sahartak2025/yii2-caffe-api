<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use app\models\Dish;
use yii\console\Controller;
use yii\console\ExitCode;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class DishInitController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
    public function actionIndex($message = 'hello world')
    {
        $dishes = [
            ['name' => 'Coffee Bon-Bon', 'cook' => 'Antonio', 'price' => 5],
            ['name' => 'Coffee Iris', 'cook' => 'John', 'price' => 3],
            ['name' => 'Latte', 'cook' => 'Smith', 'price' => 4],
            ['name' => 'Affogato', 'cook' => 'Martin', 'price' => 10],
        ];

        foreach ($dishes as $dishData) {
            $dish = new Dish();
            $dish->setAttributes($dishData);
            $dish->save();
        }

        return ExitCode::OK;
    }
}
