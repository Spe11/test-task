<?php

use yii\db\Migration;

/**
 * Class m180421_082348_answers
 */
class m180421_082348_answers extends Migration
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
        echo "m180421_082348_answers cannot be reverted.\n";

        return false;
    }

    public function up()
    {
        $this->createTable('answers',[
            'id' => $this->primaryKey(),
            'question_id' => $this->integer(),
            'user_id' => $this->integer(),
            'text' => $this->string(1000)
        ]);
    }

    public function down()
    {
        $this->dropTable('answers');
    }
}
