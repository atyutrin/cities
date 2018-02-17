<?php

use yii\db\Migration;

/**
 * Class m180216_085753_create_token_tables
 */
class m180216_085753_create_token_tables extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('token', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'token' => $this->string()->notNull()->unique(),
            'expired_at' => $this->integer()->notNull()
        ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');

        $this->createIndex('idx-token-user_id', 'token', 'user_id');
        $this->addForeignKey('fk-token-user_id', 'token', 'user_id', 'user', 'id', 'CASCADE', 'RESTRICT');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('token');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180216_085753_create_token_tables cannot be reverted.\n";

        return false;
    }
    */
}
