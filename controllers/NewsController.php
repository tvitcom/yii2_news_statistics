<?php

namespace app\controllers;

use Yii;
use app\models\News;
use app\models\Click;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * NewsController implements the CRUD actions for News model.
 */
class NewsController extends \app\controllers\PreloaderController
{  
    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'update', 'delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['create'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['delete', 'update'],
                        'matchCallback' => function ($rule, $action) {
                            return isset(Yii::$app->user->identity->id) && Yii::$app->user->identity->id === '100';
                        }
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all News models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => News::find(),
            'pagination' => [
                'forcePageParam' => false,
                'pageSizeParam' => false,
                'pageSize' => 10
            ]
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * Displays a single News model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->set_click($id, 'UA');
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new News model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new News();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing News model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing News model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    
    /*
     * Save statistic:
     */
    public function set_click($item_id, $country_code) {
        /*
        * Алгоритм:
        *  if ($news_id нет в click) {
        *     занести в click c пустыми значениями.
        *  }
        * 
        *  если (посещал уже сайт?) && (уже кликал эту новость?) {
        *     клик засчитался как общий но не как уникальный
        *  } или {
        *    клик защитался и как общий и как уникальный,
        *  }
        */
        //Save new record to click if not exist:
        if (!Click::find()->where(['news_id' => $item_id])->one()) {// if $news_id нет в click
            $geoip = new \lysenkobv\GeoIP\GeoIP();
            $ip = $geoip->ip(Yii::$app->request->userIP);
            //exit(var_dump($ip));
            //занести в click c пустыми значениями:
            $click = new Click();
            $click->news_id = intval($item_id);
            $click->unique_cnt = 0;
            $click->cnt = 0;
            $click->date_of = (new \DateTime())->format('Y-m-d');
            $click->country_code = $ip->isoCode;
            $click->save();
        }
        
        
        $country_code = $country_code;
        $cookies = Yii::$app->request->cookies;
        //exit('$this->previous_see_time: ' . $this->previous_see_time . ' var_dump-$cookies->getValue(last_see, none): ' . var_dump($cookies->get('last_see')));
        
        //если (посещал уже сайт?) && (уже кликал эту новость?)
        if (isset($this->previous_see_time) && $this->previous_see_time > 0) {        
            // клик засчитался как общий но не как уникальный:    
            Click::updateAllCounters(['cnt' => 1],'news_id = :news_id',[
                ':news_id' => $item_id,
                ]);
        } else {
            //клик защитался и как общий и как уникальный:
            Click::updateAllCounters(['unique_cnt' => 1],'news_id = :news_id',[
                    ':news_id' => $item_id,
                    ]);
            Click::updateAllCounters(['cnt' => 1],'news_id = :news_id',[
                ':news_id' => $item_id,
                ]);
        }
    }
}
