<?php

namespace app\modules\game\controllers;

use Yii;
use app\modules\game\models\Game;
use app\modules\game\models\searches\GameSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\modules\quick\models\Questions;
use app\modules\quick\models\Answers;

/**
 * GameController implements the CRUD actions for Game model.
 */
class GameController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'start', 'answers'],
                        'allow' => true,
                        'roles' => ['@'],
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

    /**
     * Lists all Game models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GameSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Game model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Game model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Game();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Game model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Game model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Game model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Game the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Game::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionStart($step=0)
    {
        $user = Yii::$app->user->identity;

        if(($loss = Yii::$app->session->get('loss')) && $loss == 1){

            Yii::$app->session->remove('loss');
        }
//        empty($game)&&
        $game = Game::findOne(['user_id' => $user->getId(), 'date_finish' => null]);
        if(empty($game) && is_null($loss)){
            $game = new Game([
                'user_id' => $user->getId(),
                'date_start' => time()
            ]);
            $game->save();
            Yii::$app->session->set('loss', 3);
        }


        if($game && $loss == 1){
            $game->date_finish=time();
            $game->save();
//            return $this->redirect(['home']);
        }
        $question = Questions::find()->orderBy('rand()')->one();
        return $this->render('start', [
            'q' => $question,
            's' => $step,
            'l' => $loss,
            'r' => $game
        ]);
//        return $step;
    }

    public function actionAnswers($question_id, $answer_id)
    {
        $user = Yii::$app->user->identity;

        $answers = Answers::findOne(['id' => $answer_id, 'correct_answer_id' => 1]);

        $ranks = Game::findOne(['user_id' => $user->getId(), 'date_finish' => null]);

        //$correct = $answer->correct_answer_id;
//        $answers = Answers::findOne(['id' => $answer_id, 'correct_answer_id' => 1]);
//        if($answers){
//            echo '
//                    <script type="text/JavaScript">
//                    document.getElementsByClassName("green")[0].className = "red";
//                    </script>';
//        }

        if($answers){
            $ranks->ranks++;
            $ranks->save();
        } else{
            $loss = Yii::$app->session->get('loss');
            --$loss;
            Yii::$app->session->set('loss', $loss);
        }
        $this->redirect(['start']);
    }
}