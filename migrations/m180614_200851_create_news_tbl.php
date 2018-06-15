<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m180614_200851_create_news_tbl
 */
class m180614_200851_create_news_tbl extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('news', [
            'id' => Schema::TYPE_BIGPK,
            'author_id' => Schema::TYPE_BIGINT,
            'title' => Schema::TYPE_STRING . ' NOT NULL',
            'content' => Schema::TYPE_TEXT,
            'd_create' => Schema::TYPE_DATE,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('news');
        //echo "m180614_200851_create_news_tbl cannot be reverted.\n";

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180614_200851_create_news_tbl cannot be reverted.\n";

        return false;
    }
    */
}
