<?php

namespace backend\controllers;

use Yii;
use common\models\Article;
use common\models\Category;
use common\models\Tag;
use common\models\ImageUpload;
use common\models\ArticleSearch;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends Controller
{
    /**
     * Lists all Article models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Article model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Article();
        $selectedTags = $model->getSelectedTags();
        $tags = ArrayHelper::map(Tag::find()->all(), 'id', 'title');
        $categories = ArrayHelper::map(Category::find()->all(), 'id', 'title');
        $selectedCategory = ($model->category) == null ? '' : $model->category->id;
        $model->user_id = Yii::$app->user->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->setImage($model);
            $this->setCategory($model);
            $this->setTags($model->id);
            return $this->redirect(['/site/index']);
        }

        return $this->render('create', [
            'tags'=>$tags,
            'model' => $model,
            'categories'=> $categories,
            'selectedTags'=>$selectedTags,
            'selectedCategory'=>$selectedCategory,
        ]);
    }

    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $selectedTags = $model->getSelectedTags();
        $tags = ArrayHelper::map(Tag::find()->all(), 'id', 'title');
        $categories = ArrayHelper::map(Category::find()->all(), 'id', 'title');
        $selectedCategory = ($model->category) == null ? '' : $model->category->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->setImage($model);
            $this->setCategory($model);
            $this->setTags($model->id);
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'tags'=>$tags,
            'model' => $model,
            'categories'=> $categories,
            'selectedTags'=> $selectedTags,
            'selectedCategory'=>$selectedCategory,
        ]);
    }

    /**
     * Deletes an existing Article model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function setImage($model)
    {
        $modelImg = new ImageUpload;
        $file = UploadedFile::getInstance($model, 'image');
        $article = $this->findModel($model->id);
        $article->saveImage($modelImg->uploadFile($file, $article->image));
    }

    public function setCategory($id)
    {
        $article = $this->findModel($id);
        $category = Yii::$app->request->post('category');
        $article->saveCategory($category);
    }

    public function setTags($id)
    {
        $article = $this->findModel($id);
        $tags = Yii::$app->request->post('tags');
        $article->saveTags($tags);
    }

}
