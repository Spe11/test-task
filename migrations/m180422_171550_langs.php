<?php

use yii\db\Migration;

/**
 * Class m180422_171550_langs
 */
class m180422_171550_langs extends Migration
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
        echo "m180422_171550_langs cannot be reverted.\n";

        return false;
    }

    public function up()
    {
        $this->addColumn('users', 'language',  $this->string(2));
    }

    public function down()
    {
        $this->dropColumn('users', 'language');
    }
}
