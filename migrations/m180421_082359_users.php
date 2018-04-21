<?php

use yii\db\Migration;

/**
 * Class m180421_082359_users
 */
class m180421_082359_users extends Migration
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
        echo "m180421_082359_users cannot be reverted.\n";

        return false;
    }

    public function up()
    {
       $this->createTable('users',[
           'id' => $this->primaryKey(),
           'username' => $this->string(30),
           'authKey' => $this->string(255),
           'password' => $this->string(255),
           'mail' => $this->string(255)
       ]);
   }

   public function down()
   {
       $this->dropTable('users');
   }
}
