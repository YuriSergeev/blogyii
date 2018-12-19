<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->title = 'Blog';
?>

<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">

                <?php foreach ($articles as $article):?>
                    <article class="post">
                      <div class="post-thumb">
                          <a href="<?= Url::toRoute(['site/article', 'id'=>$article->id]);?>"><img src="<?= $article->getImage(); ?>" alt=""></a>

                          <a href="<?= Url::toRoute(['site/article', 'id'=>$article->id]);?>" class="post-thumb-overlay text-center">
                              <div class="text-uppercase text-center">View Post</div>
                          </a>
                      </div>
                      <div class="post-content">
                          <header class="entry-header text-center text-uppercase">
                              <h6><a href="<?= Url::toRoute(['site/category/','id'=>($article->category == null) ? '' : $article->category->id]) ?>"> <?= ($article->category == null) ? '' : $article->category->title; ?> </a></h6>

                              <h1 class="entry-title"><a href="<?= Url::toRoute(['site/article', 'id'=>$article->id]);?>"> <?= $article->title; ?> </a></h1>


                          </header>
                          <div class="entry-content">
                              <p> <?= $article->getContent(); ?> </p>

                              <div class="btn-continue-reading text-center text-uppercase">
                                  <a href="blog.html" class="more-link">Continue Reading</a>
                              </div>
                          </div>
                          <div class="social-share">
                              <span class="social-share-title pull-left text-capitalize">By <?= ($article->author == null) ? '' : $article->author->username ?> On <?= $article->getDate(); ?></span>
                              <ul class="text-center pull-right">
                                  <li><a class="s-facebook" href="#"><i class="fa fa-eye"></i></a></li><?= (int) $article->viewed; ?></li>
                                  <li><a class="s-facebook" href="#"><i class="fa fa-eye"></i></a></li><?= (int) $article->viewed; ?></li>
                              </ul>
                          </div>
                      </div>
                  </article>
                <?php endforeach; ?>
                <?php
                    echo LinkPager::widget([
                        'pagination' => $pagination,
                    ]);
                ?>
            </div>
            <?= $this->render('/partials/sidebar', [
                'popular'=>$popular,
                'recent'=>$recent,
                'categories'=>$categories
            ]);?>
        </div>
    </div>
</div>
