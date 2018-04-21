<?php

use yii\db\Migration;

/**
 * Class m180421_083656_relations
 */
class m180421_083656_relations extends Migration
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
        echo "m180421_083656_relations cannot be reverted.\n";

        return false;
    }

    public function up()
    {
        $this->createIndex(
            'i-questions-user_id',
            'questions',
            'user_id'
        );
        
        $this->createIndex(
            'i-answers-user_id',
            'answers',
            'user_id'
        );

        $this->createIndex(
            'i-answers-question_id',
            'answers',
            'question_id'
        );

        $this->addForeignKey(
            'fk-questions-user_id',
            'questions',
            'user_id',
            'users',
            'id'
        );

        $this->addForeignKey(
            'fk-answers-user_id',
            'answers',
            'user_id',
            'users',
            'id'
        );

        $this->addForeignKey(
            'fk-answers-question_id',
            'answers',
            'question_id',
            'questions',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey(
            'fk-answers-question_id',
            'answers'
        );

        $this->dropForeignKey(
            'fk-answers-user_id',
            'answers'
        );

        $this->dropForeignKey(
            'fk-questions-user_id',
            'questions'
        );

        $this->dropIndex(
            'i-answers-question_id',
            'answers'
        );

        $this->dropIndex(
            'i-answers-user_id',
            'answers'
        );

        $this->dropIndex(
            'i-questions-user_id',
            'questions'
        );
    }
}
