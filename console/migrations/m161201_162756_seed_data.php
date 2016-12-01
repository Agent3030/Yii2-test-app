<?php

use yii\db\Migration;

class m161201_162756_seed_data extends Migration
{
    public function safeUp()
    {
        $this->insert('{{%user}}', [

            'username' => 'admin',
            'email' => 'admin@example.com',
            'password_hash' => Yii::$app->getSecurity()->generatePasswordHash('admin'),
            'auth_key' => Yii::$app->getSecurity()->generateRandomString(),
            'status' => \common\models\User::STATUS_ACTIVE,
            'created_at' => time(),
            'updated_at' => time()
        ]);



        $this->insert('{{%user}}', [

            'username' => 'moderator',
            'email' => 'moderator@example.com',
            'password_hash' => Yii::$app->getSecurity()->generatePasswordHash('moderator'),
            'auth_key' => Yii::$app->getSecurity()->generateRandomString(),
            'status' => \common\models\User::STATUS_ACTIVE,
            'created_at' => time(),
            'updated_at' => time()
        ]);



        $this->insert('{{%user}}', [

            'username' => 'user',
            'email' => 'user@example.com',
            'password_hash' => Yii::$app->getSecurity()->generatePasswordHash('user'),
            'auth_key' => Yii::$app->getSecurity()->generateRandomString(),
            'status' => \common\models\User::STATUS_ACTIVE,
            'created_at' => time(),
            'updated_at' => time()
        ]);



    }

    public function safeDown()
    {

        $this->delete('{{%user}}', [
            'id' => [1, 2, 3]
        ]);
    }
}
