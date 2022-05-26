<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Category;
use common\models\Person;

/* @var $this yii\web\View */
/* @var $model common\models\Course */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="course-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?php

     echo $form->field($model, 'category_id')->dropdownList(ArrayHelper::map(Category::find()->all(), 'id', 'title'),
            ['prompt'=>'Kategoriyani tanlang']
        );

          echo $form->field($model, 'author_id')->dropdownList(ArrayHelper::map(Person::find()->all(), 'id', 'first_name'),
            ['prompt'=>'Muallifni tanlang']
        );
    ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'level')->textInput() ?>

    <?= $form->field($model, 'photo')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
