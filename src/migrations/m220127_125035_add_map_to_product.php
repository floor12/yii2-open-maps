<?php

use yii\db\Migration;

/**
 * Class m220127_125035_add_map_to_product
 */
class m220127_125035_add_map_to_product extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('product', 'map_id', $this->integer()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('product', 'map_id');
    }
}
