<?php

use yii\db\Migration;

/**
 * Class m180215_024138_create_tables
 */
class m180215_024138_create_tables extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('country', [
            'id' => $this->primaryKey(),
            'name' => $this->string(128)->notNull(),
        ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');

        $this->createTable('region', [
            'id' => $this->primaryKey(),
            'name' => $this->string(256),
            'country_id' => $this->integer()->notNull(),
        ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');

        $this->createIndex('idx-region-country_id', 'region', 'country_id');
        $this->addForeignKey('fk-region-country_id', 'region', 'country_id', 'country', 'id', 'CASCADE', 'CASCADE');

        $this->createTable('city',[
            'id' => $this->primaryKey(),
            'name' => $this->string(256),
            'region_id' => $this->integer()->notNull()
        ],'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');

        $this->createIndex('idx-city-region_id', 'city', 'region_id');
        $this->addForeignKey('fk-city-region_id', 'city', 'region_id', 'region', 'id', 'CASCADE', 'CASCADE');

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('country');
        $this->dropTable('region');
        $this->dropTable('city');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180215_024138_create_tables cannot be reverted.\n";

        return false;
    }
    */
}
