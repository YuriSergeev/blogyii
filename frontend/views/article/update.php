<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Article */

$this->title = 'Update Article: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="article-update">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
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
</div>
