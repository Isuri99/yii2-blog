<?php

namespace app\controllers;

use app\models\Article;
use app\models\ArticleSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\rbac\AuthorRule;
use yii\web\UploadedFile;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends Controller
{
    /**
     * @inheritDoc
     */
  /*  public function behaviors()
    {
        return
            [
                [
                    'class' => AccessControl::class,
                    'only' => ['create', 'update', 'delete'],
                    'rules' => [
                        [
                            'actions' => ['update', 'create', 'delete'],
                            'allow' => true,
                            'roles' => ['@']
                        ],
                    ],
                ],

                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ];

    }
*/

 /**
     * Lists all Article models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Article model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($slug)
    {

        return $this->render('view', [
            'model' => $this->findModel($slug),
        ]);
    }

    /**
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Article();

        if (\Yii::$app->user->can('createPost')) {
        }

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {

                $model->image =UploadedFile::getInstance($model, 'image');
                $image_name =$model->title.rand(1,4000).'.'.$model->image->extension;
                $image_path = 'uploads/articles/' .$image_name;
                $model->image->saveAs($image_path);
                $model->image= $image_path;
                $model->save();

                return $this->redirect(['view', 'slug' => $model->slug]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($slug)
    {
        $model = $this->findModel($slug);

        if(\Yii::$app->user->can('updatePost', ['article'=>$model]) ){

            if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
                $model->image =UploadedFile::getInstance($model, 'image');
                $image_name =$model->title.rand(1,4000).'.'.$model->image->extension;
                $image_path = 'uploads/articles/' .$image_name;
                $model->image->saveAs($image_path);
                $model->image= $image_path;
                $model->save();

                return $this->redirect(['view', 'slug' => $model->slug]);
            }else{
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }else {
            throw new ForbiddenHttpException;
        }
    }

    /* public function actionUpdate($slug)
     {
         $model = $this->findModel($slug);

         // Check if the current user can update either their own post or any post
         if (\Yii::$app->user->can('updateOwnPost', ['article' => $model]) || \Yii::$app->user->can('updatePost')) {
             if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
                 return $this->redirect(['view', 'slug' => $model->slug]);
             } else {
                 return $this->render('update', [
                     'model' => $model,
                 ]);
             }
         } else {
             throw new ForbiddenHttpException;
         }
     }*/


    /**
     * Deletes an existing Article model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($slug)
    {
        $model = $this->findModel($slug);
        if (\Yii::$app->user->can('deletePost', ['article'=>$model])){



            $model->delete();

            return $this->redirect(['index']);
        }else{
            throw new ForbiddenHttpException;
        }
    }



    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($slug)
    {
        if (($model = Article::findOne(['slug' => $slug])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


}
