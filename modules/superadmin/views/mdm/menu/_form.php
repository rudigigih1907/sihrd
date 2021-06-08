<?php

use mdm\admin\AutocompleteAsset;
use mdm\admin\models\Menu;
use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model mdm\admin\models\Menu */
/* @var $form yii\widgets\ActiveForm */
AutocompleteAsset::register($this);
$opts = Json::htmlEncode([
    'menus' => Menu::getMenuSource(),
    'routes' => Menu::getSavedRoutes(),
]);
$this->registerJs("var _opts = $opts;");
$this->registerJs($this->render('_script.js'));
?>

    <div class="menu-form">

        <?php $form = ActiveForm::begin(); ?>
        <div class="card shadow">

            <?= Html::activeHiddenInput($model, 'parent', ['id' => 'parent_id']); ?>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <?= $form->field($model, 'name')->textInput(['maxlength' => 128]) ?>

                        <?= $form->field($model, 'parent_name')->textInput(['id' => 'parent_name']) ?>

                        <?= $form->field($model, 'route')->textInput(['id' => 'route']) ?>
                    </div>
                    <div class="col-sm-6">
                        <?= $form->field($model, 'order')->input('number') ?>

                        <p>
                            <?= Html::button(FAS::icon(FAS::_COG) . ' Activate By Controller', [
                                'class' => 'btn btn-outline-primary',
                                'onClick' => 'activate("controller")'
                            ]) ?>
                            <?= Html::button(FAS::icon(FAS::_COG) . ' Activate By Module', [
                                'class' => 'btn btn-outline-primary',
                                'onClick' => 'activate("module")'
                            ]) ?>
                        </p>

                        <?= $form->field($model, 'data')->textarea(['rows' => 4]) ?>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <div class="d-flex justify-content-between">
                    <?= Html::submitButton(FAS::icon(FAS::_SAVE) . ' Save', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>

<?php


$js = <<<JS

    function activate(mode){     
    
        let route = jQuery('#route');
        let stringRoute =  route.val();
        let stringSplit = stringRoute.split("/");
        
        stringSplit.shift();
        stringSplit.pop();
        
        let controller = '';
        let module = '';
        let stringTemplate;
        
        if(mode === 'module'){
            module = stringSplit[0];
            controller = stringSplit[1];
            stringTemplate  = "return[" + "'module' => '" + module + "', 'controller' => '" + controller + "'];";
        }else{
            controller = stringSplit[0];
            stringTemplate  = "return[" + "'controller' => '" + controller + "'];";
        }
        
        jQuery('#menu-data').val(stringTemplate);
        
    }
JS;

$this->registerJs($js, View::POS_HEAD);

