<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "region".
 *
 * @property int $id
 * @property string $name
 * @property int $country_id
 *
 * @property City[] $cities
 * @property Country $country
 */
class Region extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'region';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['country_id'], 'required'],
            [['country_id'], 'integer'],
            [['name'], 'string', 'max' => 256],
            [['country_id', 'name'], 'unique', 'targetAttribute' => ['country_id', 'name']],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['country_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'country_id' => 'Country',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCities()
    {
        return $this->hasMany(City::className(), ['region_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'country_id']);
    }

    public static function listWithCountry()
    {
        $countries = self::find()->select(['region.id', 'CONCAT(region.name, ". ", country.name) as name'])
                                  ->joinWith('country')
                                  ->all();
        $data = yii\helpers\ArrayHelper::map($countries, 'id', 'name');
        return $data;
    }

    public function fields()
    {
        $fields = parent::fields();
        unset($fields['country_id']);
        return $fields;
    }
}
