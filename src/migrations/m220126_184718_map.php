<?php

use yii\db\Migration;

/**
 * Class m220126_184718_map
 */
class m220126_184718_map extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('map', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'title' => $this->string()->notNull(),
            'init_lat' => $this->double()->notNull()->defaultValue(39.4567),
            'init_lng' => $this->double()->notNull()->defaultValue(-0.3670),
            'init_zoom' => $this->integer()->notNull()->defaultValue(13),
            'points' => $this->json()->null()
        ]);

        $this->createIndex('map-created_at', 'map', 'created_at');
        $this->createIndex('map-updated_at', 'map', 'updated_at');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('map');
    }

}
