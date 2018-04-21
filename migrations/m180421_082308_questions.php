<?php

use yii\db\Migration;

/**
 * Class m180421_082308_questions
 */
class m180421_082308_questions extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180421_082308_questions cannot be reverted.\n";

        return false;
    }

    public function up()
    {
        $this->createTable('questions',[
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'text' => $this->string(1000),
            'status' => $this->boolean()
        ]);
    }

    public function down()
    {
        $this->dropTable('questions');
    }
}
