<?php

use yii\db\Migration;

/**
 * Class m240524_105505_application_table
 */
class m240524_105505_application_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('application', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'user_id' => $this->integer(),
            'date' => $this->date(),
            'car' => $this->string(),
            'status' => $this->integer()
        ]);

        $this->createIndex(
            'idx-application-user_id',
            'application',
            'user_id'
        );

        $this->addForeignKey(
            'fk-application-user_id',
            'application',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240524_105505_application_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240524_105505_application_table cannot be reverted.\n";

        return false;
    }
    */
}
