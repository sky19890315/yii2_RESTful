<?php

namespace api\models;

use Yii;

/**
 * This is the model class for table "cars".
 *
 * @property integer $cars_id
 * @property string $carname
 * @property string $carage
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
            [['carname', 'color'], 'required'],
            [['carage'], 'safe'],
            [['carname'], 'string', 'max' => 40],
            [['color'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cars_id' => 'Cars ID',
            'carname' => 'Carname',
            'carage' => 'Carage',
            'color' => 'Color',
        ];
    }
}
