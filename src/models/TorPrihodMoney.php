<?php

namespace voganu\tornado\models;

//use voganu\tornado\models\Postav;
//use voganu\tornado\models\Procent;
use Yii;

/**
 * This is the model class for table "tor_prihod".
 *
 * @property int $id
 * @property string $prihod_date
 * @property double $kassa
 * @property double $terminal
 */

class TorPrihodMoney extends \yii\db\ActiveRecord
{
//    public $dolg;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tor_prihod_money';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['prihod_date'], 'required'],
//            [['prihod_date'], 'date'],
            [['kassa', 'terminal', 'prihod_date'], 'safe'],
            [['kassa', 'terminal'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'prihod_date' => 'дата прихода',
            'kassa' => 'касса',
            'terminal' => 'терминал',
        ];
    }

    public function afterFind()
    {
        parent::afterFind();
        $phpdate = strtotime( $this->prihod_date);
        $this->prihod_date = date('d/m/Y',$phpdate);
    }

    public function beforeSave($insert) {
        if($this->prihod_date){
            $date = \DateTime::createFromFormat('d/m/Y', $this->prihod_date);
            $this->prihod_date = $date->format('Y-m-d');
        }
        return parent::beforeSave($insert);
    }
}
