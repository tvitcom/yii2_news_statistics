<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Click */

$this->title = Yii::t('app', 'Create Click');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Clicks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="click-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
