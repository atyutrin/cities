<?php

namespace api\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "token".
 *
 * @property int $id
 * @property int $user_id
 * @property string $token
 * @property int $expired_at
  */
class Token extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'token';
    }

    public function generateToken($expire)
    {
        $this->expired_at = $expire;
        $this->token = Yii::$app->security->generateRandomString();
    }
}
