<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cooks}}`.
 */
class m230411_121609_create_dishes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%dishes}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'cook' => $this->string()->notNull(),
            'price' => $this->float()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%dishes}}');
    }
}
