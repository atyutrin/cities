<?php

use yii\db\Migration;

/**
 * Class m180217_090456_add_test_data
 */
class m180217_090456_add_test_data extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->batchInsert('country', [], [
            [1, 'Россия'],
            [3, 'Казахстан'],
            [4, 'USA']
        ]);

        $this->batchInsert('region',[],[
            [2, 'Московская область', 1],
            [3, 'Алматинская область', 3],
            [4, 'Красноярский край', 1],
            [5, 'Иркутская область', 1],
            [8, 'Волгоградская область', 1],
            [9, 'California', 4]
        ]);

        $this->batchInsert('city',[],[
            [2, 'Москва', 2],
            [4, 'Алматы', 3],
            [5, 'Красноярск', 4],
            [6, 'пос Быково', 2],
            [7, 'пос Быково', 8],
            [9, 'San Francisco', 9]
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->delete('country', 'id in (1,3,4)');
        $this->delete('region', 'id in (2,3,4,5,8,9)');
        $this->delete('city', 'id in (2,4,5,6,7,9)');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180217_090456_add_test_data cannot be reverted.\n";

        return false;
    }
    */
}
