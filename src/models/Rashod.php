<?php

namespace voganu\tornado\models;

use Yii;
use yii\helpers\Inflector;
use luya\helpers\Url;
use voganu\tornado\admin\Module;
use luya\admin\aws\TagActiveWindow;
use luya\admin\ngrest\base\NgRestModel;
use luya\admin\traits\SoftDeleteTrait;
use luya\admin\traits\TagsTrait;

/**
 * This is the model class for table "news_article".
 *
 * @property integer $id
 * @property string $title
 * @property string $text
 * @property integer $cat_id
 * @property string $image_id
 * @property string $image_list
 * @property string $file_list
 * @property integer $create_user_id
 * @property integer $update_user_id
 * @property integer $timestamp_create
 * @property integer $timestamp_update
 * @property integer $timestamp_display_from
 * @property integer $timestamp_display_until
 * @property integer $is_deleted
 * @property integer $is_display_limit
 * @property string $teaser_text
 * @property string $detailUrl Return the link to the detail url of a news item.
 * @author Basil Suter <basil@nadar.io>
 */
class Rashod extends NgRestModel
{
    use
        //SoftDeleteTrait,
        TagsTrait;
    
//    public $i18n = ['name', 'description'];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tor_rashod';
    }

    /**
     * @inheritdoc
     */
//    public function init()
//    {
//        parent::init();
//        $this->on(self::EVENT_BEFORE_INSERT, [$this, 'eventBeforeInsert']);
//        $this->on(self::EVENT_BEFORE_UPDATE, [$this, 'eventBeforeUpdate']);
//    }
//
//    public function eventBeforeUpdate()
//    {
//        $this->update_user_id = Yii::$app->adminuser->getId();
//        $this->timestamp_update = time();
//    }
//
//    public function eventBeforeInsert()
//    {
//        $this->create_user_id = Yii::$app->adminuser->getId();
//        $this->update_user_id = Yii::$app->adminuser->getId();
//        $this->timestamp_update = time();
//        if (empty($this->timestamp_create)) {
//            $this->timestamp_create = time();
//        }
//        if (empty($this->timestamp_display_from)) {
//            $this->timestamp_display_from = time();
//        }
//    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rashod_date', 'rashod_summa', 'postav_id'], 'required'],
            [['rashod_date'], 'date'],
            [['rashod_date', 'rashod_summa', 'postav_id'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
//    public function attributeLabels()
//    {
//        return [
//            'name' => Module::t('name'),
//            'description' => Module::t('description'),
//            'status_id' => Module::t('status')
//        ];
//    }
    
    /**
     * @inheritdoc
     */
    public function ngRestAttributeTypes()
    {
        return [
            'rashod_date' => 'date',
            //'status_id' =>['selectArray', 'data' =>[0 => 'Mr', 1 => 'Mrs']]
//            'procent_id' =>['selectModel', 'modelClass' => Procent::class, 'valueField' => 'id', 'labelField' => 'name']
        ];
    }

    /**
     *
     * @return string
     */
    public function getDetailUrl()
    {
        return Url::toRoute(['/tornado/default/detail', 'id' => $this->id, 'name' => Inflector::slug($this->name)]);
    }

    /**
     * Get image object.
     * 
     * @return \luya\admin\image\Item|boolean
     */
//    public function getImage()
//    {
//    	return Yii::$app->storage->getImage($this->image_id);
//    }
    
    /**
     * @inheritdoc
     */
    public static function ngRestApiEndpoint()
    {
        return 'api-tornado-rashod';
    }
    
    /**
     * @inheritdoc
     */
//    public function ngRestAttributeGroups()
//    {
//        return [
//            [['timestamp_create', 'timestamp_display_from', 'is_display_limit', 'timestamp_display_until'], 'Time', 'collapsed'],
//            [['image_id', 'image_list', 'file_list'], 'Media'],
//        ];
//    }
    
    /**
     * @inheritdoc
     */
//    public function ngRestScopes()
//    {
//        return [
//            [['list'], ['name', 'description', 'status_id']],
//            [['create', 'update'], ['name', 'description', 'status_id']],
//            [['delete'], true],
//        ];
//    }
    
    /**
     * @inheritdoc
     */
    public function ngRestActiveWindows()
    {
        return [
            ['class' => TagActiveWindow::class],
        ];
    }


    /**
     *
     * @return \yii\db\ActiveQuery
     */
//    public function getPrihod()
//    {
//        return $this->hasOne(Prihod::class, ['id' => 'prihod_id']);
//    }
    
    /**
     * The cat name short getter.
     *
     * @return string
     */
//    public function getCategoryName()
//    {
//        return $this->cat->title;
//    }
}
