<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Article */

$this->title = 'Create Article';
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-10 col-md-offset-1">
      <h1><?= Html::encode($this->title) ?></h1>

      <?= $this->render('_form', [
          'tags'=>$tags,
          'model' => $model,
          'categories'=> $categories,
          'selectedTags'=> $selectedTags,
          'selectedCategory'=>$selectedCategory,
      ]) ?>
    </div>
</div>
