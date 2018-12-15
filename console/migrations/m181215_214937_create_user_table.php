<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m181215_214937_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'email' => $this->string()->defaultValue(null),
            'password' => $this->string(),
            'role' => $this->string()->defaultValue('User'),
            'photo' => $this->string()->defaultValue(null),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user');
    }
}
