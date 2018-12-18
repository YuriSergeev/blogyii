<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_role`.
 */
class m181218_120917_create_user_role_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user_role', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'role_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user_role');
    }
}
