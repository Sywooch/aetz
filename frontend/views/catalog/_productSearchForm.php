<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use frontend\models\Filter;
use yii\helpers\ArrayHelper;
use common\models\Category;
use common\models\Attribute;

?>
<div class="catalog-form-block">
    <div class="catalog-search-block">
        <div class="col-xs-12">
            <div class="catalog-form-block-header">Расширенный поиск</div>

            <div class="border-price">
                <?php
                $form = ActiveForm::begin(
                    [
                        'id' => 'search-form',
                        'action' => Url::toRoute(['/catalog/list', 'id' => $categoryId]),
                        'method' => 'GET',
                        'options' => [
                            //'class' => 'form-inline'
                        ]
                    ]
                );
                ?>
                <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map(Category::find()->where(['parent_id' => $category->parent_id])->all(), 'id', 'title'), ['class' => 'form-control search-item input-sm'])->label('Выберите категорию') ?>
                <?php if ($category->parent_id != 3) { ?>
                    <div>
                        <div>
                            <label class="control-label" for="objectparam-1-value">Стоимость</label>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 no-padding-right">
                                <?= $form->field($model, 'price_begin', ['inputOptions' => ['class' => 'form-control input-sm search-item', 'placeholder' => 'от']])->textInput()->label(false) ?>
                            </div>

                            <div class="col-xs-6 no-padding-right">
                                <?= $form->field($model, 'price_end', ['inputOptions' => ['class' => 'form-control input-sm search-item', 'placeholder' => 'до']])->textInput()->label(false) ?>
                            </div>
                        </div>

                    </div>
                <?php } ?>

                <?php foreach ($category->filterAttributes as $attribute) { ?>

                    <?php if ($attribute->type_id == Attribute::TYPE_TEXT) { ?>

                        <label class="control-label" for="objectparam-1-value"><?= $attribute->title ?></label>
                        <div class="row">
                            <div class="col-xs-6 no-padding-right">
                                <?= $form->field($productAttributeModel[$attribute->id . '_from'], '[' . $attribute->id . '_from]value')->textInput(['placeholder' => 'от', 'class' => 'form-control input-sm search-item'])->label(false) ?>
                            </div>
                            <div class="col-xs-6">
                                <?= $form->field($productAttributeModel[$attribute->id . '_to'], '[' . $attribute->id . '_to]value')->textInput(['placeholder' => 'до', 'class' => 'form-control input-sm search-item'])->label(false) ?>
                            </div>
                        </div>


                    <?php } ?>

                    <?php if ($attribute->type_id == Attribute::TYPE_SELECT) { ?>
                        <?= $form->field($productAttributeModel[$attribute->id], '[' . $attribute->id . ']value')->dropDownList(ArrayHelper::map($attribute->attributeOptions, 'id', 'value'), ['prompt' => 'Выберите', 'class' => 'form-control search-item input-sm'])->label($attribute->title) ?>
                    <?php } ?>

                    <?php if ($attribute->type_id == Attribute::TYPE_CHECKBOXLIST) { ?>
                        <?= $form->field($productAttributeModel[$attribute->id], '[' . $attribute->id . ']value')->checkboxList(ArrayHelper::map($attribute->attributeOptions, 'id', 'value'))->label($attribute->title) ?>
                    <?php } ?>

                    <?php if ($attribute->type_id == Attribute::TYPE_COLOR) { ?>
                        <?php
                        $attributeValues = ArrayHelper::map($attribute->attributeOptions, 'id', 'value');
                        ?>


                        <?php
                        echo $form->field($productAttributeModel[$attribute->id], '[' . $attribute->id . ']value')->
                        checkboxList($attributeValues, ['item' => function ($index, $label, $name, $checked, $value) {
                            return Html::checkbox($name, $checked, [
                                'value' => $value,
                                'id' => 'checkbox' . $label,
                                'label' => '<label for="checkbox' . $label . '"></label>',
                                'labelOptions' => ['class' => 'checkboxColor checkbox-icon-col-' . $label]
                            ]);
                        }])->label($attribute->title)
                        ?>

                    <?php } ?>
                <?php } ?>



                <div class="clearfix"></div>
                <div class="text-center">
                    <?= Html::submitButton('Найти', ['class' => 'btn btn-danger searchform-button', 'name' => 'search-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>


</div>
