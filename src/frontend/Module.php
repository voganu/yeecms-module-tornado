<?php

namespace voganu\tornado\frontend;

/**
 * News Frontend Module.
 *
 * @author Basil Suter <basil@nadar.io>
 */
final class Module extends \yii\base\Module
{
    /**
     * @var boolean use the application view folder
     */
    public $useAppViewPath = true;

    /**
     * @var array The default order for the article overview in the index action for the news.
     *
     * In order to read more about activeDataProvider defaultOrder: http://www.yiiframework.com/doc-2.0/yii-data-sort.html#$defaultOrder-detail
     */
    public $articleDefaultOrder = ['timestamp_create' => SORT_DESC];
    
    /**
     * @var integer Default number of pages.
     */

    /**
     * @var array The default order for the category article list in the category action for the news.
     *
     * In order to read more about activeDataProvider defaultOrder: http://www.yiiframework.com/doc-2.0/yii-data-sort.html#$defaultOrder-detail
     */

    /**
     * @var integer Default number of pages.
     */
    public $categoryArticleDefaultPageSize = 10;
    
    /**
     * @var array
     */
    public $urlRules = [
//        ['pattern' => 'shop', 'route' => 'tornado/default/index'], // equals to: 'my-basket' => 'estore/basket/index'
//        ['pattern' => 'sprav', 'route' => 'tornado/sprav/index'], // equals to: 'my-basket' => 'estore/basket/index'
//        ['pattern' => 'rashod_detail', 'route' => 'tornado/rashod/detail'], // equals to: 'my-basket' => 'estore/basket/index'

//        ['pattern' => 'tornado/<id:\d+>/<title:[a-zA-Z0-9\-]+>/', 'route' => 'tornado/default/detail'],
    ];
}
