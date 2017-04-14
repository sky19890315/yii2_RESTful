<?php

namespace api\models;

use Yii;

/**
 * This is the model class for table "TestOrder".
 *
 * @property integer $TestOrderNO_id
 * @property string $ItemNO
 * @property string $State
 * @property string $Priority
 * @property string $MachineType
 * @property string $SampleNO
 * @property string $SampleName
 * @property string $Count
 * @property string $DelegationDepartment
 * @property string $Inspector
 * @property string $ExperimentArea
 * @property string $DelegationPerson
 * @property string $DelegationDate
 * @property string $DutyDepartment
 * @property string $Purpose
 * @property string $InspectionDate
 * @property string $EstimatedDate
 * @property string $Affiliation
 * @property string $SampleBrand
 * @property string $SampleComment
 * @property string $InspectionBatchNO
 * @property string $CompressorType
 * @property string $ControllerType
 * @property string $InternalUnitNO
 * @property string $ExternalUnitNO
 * @property string $EstimatedLastDate
 * @property string $SchemeNO
 * @property string $InstallationCode
 * @property string $ReceivedTime
 * @property string $Memo
 *
 * @property TestMachine $testMachine
 */
class Testorder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TestOrder';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['DelegationDate', 'InspectionDate', 'EstimatedDate', 'EstimatedLastDate', 'ReceivedTime'], 'safe'],
            [['ItemNO', 'State', 'Priority', 'MachineType', 'SampleNO', 'SampleName', 'Count', 'DelegationDepartment', 'Inspector', 'ExperimentArea', 'DelegationPerson', 'DutyDepartment', 'Purpose', 'Affiliation', 'SampleBrand', 'SampleComment', 'InspectionBatchNO', 'CompressorType', 'ControllerType', 'InternalUnitNO', 'ExternalUnitNO', 'SchemeNO', 'InstallationCode', 'Memo'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'TestOrderNO_id' => 'Test Order No ID',
            'ItemNO' => 'Item No',
            'State' => 'State',
            'Priority' => 'Priority',
            'MachineType' => 'Machine Type',
            'SampleNO' => 'Sample No',
            'SampleName' => 'Sample Name',
            'Count' => 'Count',
            'DelegationDepartment' => 'Delegation Department',
            'Inspector' => 'Inspector',
            'ExperimentArea' => 'Experiment Area',
            'DelegationPerson' => 'Delegation Person',
            'DelegationDate' => 'Delegation Date',
            'DutyDepartment' => 'Duty Department',
            'Purpose' => 'Purpose',
            'InspectionDate' => 'Inspection Date',
            'EstimatedDate' => 'Estimated Date',
            'Affiliation' => 'Affiliation',
            'SampleBrand' => 'Sample Brand',
            'SampleComment' => 'Sample Comment',
            'InspectionBatchNO' => 'Inspection Batch No',
            'CompressorType' => 'Compressor Type',
            'ControllerType' => 'Controller Type',
            'InternalUnitNO' => 'Internal Unit No',
            'ExternalUnitNO' => 'External Unit No',
            'EstimatedLastDate' => 'Estimated Last Date',
            'SchemeNO' => 'Scheme No',
            'InstallationCode' => 'Installation Code',
            'ReceivedTime' => 'Received Time',
            'Memo' => 'Memo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTestMachine()
    {
        return $this->hasOne(TestMachine::className(), ['TestMachine_id' => 'TestOrderNO_id']);
    }
}
