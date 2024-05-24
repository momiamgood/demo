<?php

use yii\db\Migration;

/**
 * Class m240524_104530_user_table
 */
class m240524_104530_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'phone' => $this->string(),
            'password' => $this->string(),
            'email' => $this->string()->unique(),
            'full_name' => $this->string(),
            'role' => $this->integer(),
            'car_data' => $this->string()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240524_104530_user_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240524_104530_user_table cannot be reverted.\n";

        return false;
    }
    */
}
