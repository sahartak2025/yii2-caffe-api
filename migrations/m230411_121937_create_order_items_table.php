<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order_items}}`.
 */
class m230411_121937_create_order_items_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order_dishes}}', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer(),
            'dish_id' => $this->integer(),
            'quantity' => $this->integer()->defaultValue(1)
        ]);

        $this->addForeignKey(
            'order_dishes_order',
            '{{%order_dishes}}',
            'order_id',
            '{{%orders}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'order_dishes_dish',
            '{{%order_dishes}}',
            'dish_id',
            '{{%dishes}}',
            'id',
            'SET NULL',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%order_dishes}}');
    }
}
