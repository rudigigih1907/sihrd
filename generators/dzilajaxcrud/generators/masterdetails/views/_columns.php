<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\helpers\Inflector;
use yii\helpers\StringHelper;


/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$modelClass = StringHelper::basename($generator->modelClass);
$urlParams = $generator->generateUrlParams();
$nameAttribute = $generator->getNameAttribute();
$actionParams = $generator->generateActionParams();

echo "<?php\n";

?>
use yii\helpers\Url;

return [
/*    [
'class' => 'kartik\grid\CheckboxColumn',
'width' => '20px',
],
*/
[
'class' => 'kartik\grid\SerialColumn',
'width' => '30px',
'mergeHeader' => false
],
<?php
$count = 0;
foreach ($generator->getColumnNames() as $name) {
    if ($name=='id'||$name=='created_at'||$name=='updated_at' ||$name=='created_by'||$name=='updated_by'){
        echo "    // [\n";
        echo "        // 'class'=>'\kartik\grid\DataColumn',\n";
        echo "        // 'attribute'=>'" . $name . "',\n";
        echo "    // ],\n";
    } else if (++$count < 6) {
        echo "    [\n";
        echo "        'class'=>'\kartik\grid\DataColumn',\n";
        echo "        'attribute'=>'" . $name . "',\n";
        echo "        'headerOptions'=>['class' => 'text-nowrap'],\n";
        echo "        'contentOptions'=>['class' => 'text-nowrap'],\n";
        echo "    ],\n";
    } else {
        echo "    // [\n";
        echo "        // 'class'=>'\kartik\grid\DataColumn',\n";
        echo "        // 'attribute'=>'" . $name . "',\n";
        echo "        // 'headerOptions'=>['class' => 'text-nowrap'],\n";
        echo "        // 'contentOptions'=>['class' => 'text-nowrap'],\n";
        echo "    // ],\n";
    }
}
?>
[
'class' => 'kartik\grid\ActionColumn',
],

];   