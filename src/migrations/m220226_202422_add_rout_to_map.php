<?php

use yii\db\Migration;

/**
 * Class m220226_202422_add_rout_to_map
 */
class m220226_202422_add_rout_to_map extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('map', 'draw_path', $this->boolean()->defaultValue(false)->null());
        $this->alterColumn('map', 'draw_path', $this->boolean()->defaultValue(false)->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('map', 'draw_path');
    }
}