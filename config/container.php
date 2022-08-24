<?php

use kartik\grid\GridView;
use nterms\pagesize\PageSize;

$layout = <<<HTML
            <div class="pull-left" style="margin-bottom: 5px;">{pagesize}</div>
            <div class="pull-right">{summary}</div>
            <div class="clearfix"></div>
            {items}
            {pager}
HTML;

date_default_timezone_set('Asia/Beirut');

Yii::$container->set('yii\data\Pagination', [
    'pageSizeLimit' => [1, 50],
    'defaultPageSize' => 5
]);

Yii::$container->set(GridView::className(), [
    'layout' => $layout,
    'pager' => [
        'firstPageLabel' => 'First',
        'lastPageLabel' => 'Last',
        'maxButtonCount' => 3,
    ],
    'replaceTags' => [
        '{pagesize}' => function($widget) {
            return PageSize::widget([
//                        'template' => '{label} {list}',
                        'template' => ' {list}',
                        'options' => [
                            'id' => 'pagesize',
                            'class' => 'form-control input-sm'
                        ],
                        'sizes' => [5 => 5, 10 => 10, 20 => 20, 50 => 50],
                        'defaultPageSize' => 5
            ]);
        }
    ],
    'filterSelector' => '#pagesize',
    'responsiveWrap' => false,
    'condensed' => true,
    'pjax' => true,
    'resizableColumns' => false,
]);




