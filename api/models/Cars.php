<?php

namespace api\models;

use Yii;

/**
 * This is the model class for table "cars".
 *
 * @property integer $carId
 * @property string $name
 * @property string $age
 * @property string $color
 */
class Cars extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cars';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'age', 'color'], 'required'],
            [['age'], 'safe'],
            [['name', 'color'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'carId' => 'Car ID',
            'name' => 'Name',
            'age' => 'Age',
            'color' => 'Color',
        ];
    }
}
