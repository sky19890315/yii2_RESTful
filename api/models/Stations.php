<?php

namespace api\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "StationInfo".
 *
 * @property integer $Station_id
 * @property string $Area
 * @property string $StationName
 * @property string $LastActiveTime
 * @property string $MeterChannel
 */
class Stations extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'StationInfo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Area'], 'required'],
            [['LastActiveTime'], 'safe'],
            [['Area', 'StationName', 'MeterChannel'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Station_id' => 'Station ID',
            'Area' => 'Area',
            'StationName' => 'Station Name',
            'LastActiveTime' => 'Last Active Time',
            'MeterChannel' => 'Meter Channel',
        ];
    }
    
    /*
    public function fields ()
    {
	    return [
	        'Station_id',
		    'Area',
	    ];
    }
	*/
	
}
