<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m180614_200838_create_click_tbl
 */
class m180614_200838_create_click_tbl extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('click', [
            'id' => Schema::TYPE_BIGPK,
            'news_id' => Schema::TYPE_BIGINT,
            'unique_cnt' => Schema::TYPE_BIGINT,
            'cnt' => Schema::TYPE_BIGINT,
            'country_code' => Schema::TYPE_STRING,// . ' NOT NULL',
            'date_of' => Schema::TYPE_DATE,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180614_200838_create_click_tbl cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180614_200838_create_click_tbl cannot be reverted.\n";

        return false;
    }
    */
}
