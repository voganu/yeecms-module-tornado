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
 * @property double $prihod_summa
 * @property double $rashod_summa
 * @property int $procent_id
 * @property string $nakl
 * @property int $postav_id
 *
 * @property Postav $postav
 * @property Procent $procent
 */
class TorProcent extends TorPostav
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tor_procent';
    }

    /**
     * {@inheritdoc}
     */

}
