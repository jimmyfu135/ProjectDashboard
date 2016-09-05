<?php
namespace backend\controllers;

use common\models\User;
use Yii;
use yii\helpers\Json;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\Projectplan;
use common\models\Task;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     * 这里还会配置允许访问的路由规则！！！！！！！！！！！！！！！！！！
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['requirement-calendar-list', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['task-calendar-list', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['user-list', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['get-current-department', 'error'],
                        'allow' => true,
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login() && LoginForm::setMySession(true)) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        LoginForm::setMySession(false);
        return $this->goHome();
    }
    
    //返回日志表的数据
    public  function actionRequirementCalendarList(){
        /*$calendarList = [
            [
            'title' =>  'All Day Event',
            'start' =>  '2016-05-01'
            ],
            [
                'title' =>  'sdfsdf',
                'start' =>  '2016-06-01'
            ],
        ];*/
        //获取组的参数
        $departName = $_GET["abuname"];
        $calendarList = Projectplan::requirementCalendarList($departName);
        return Json::encode($calendarList);
    }

    public  function actionTaskCalendarList(){
        /*$calendarList = [
            [
            'title' =>  'All Day Event',
            'start' =>  '2016-05-01'
            ],
            [
                'title' =>  'sdfsdf',
                'start' =>  '2016-06-01'
            ],
        ];*/
        //获取组的参数
        $departName = $_GET["abuname"];
        $calendarList = Task::taskCalendarList($departName);
        return Json::encode($calendarList);
    }

    public  function actionUserList(){
        $departName = $_GET["abuname"];
        $calendarList = User::userListByDepartname($departName);
        return Json::encode($calendarList);
    }

    public function actionGetCurrentDepartment(){
        $userid = yii::$app->user->id;
        $user=new User();
        $user=User::findIdentity($userid);
        return $user->departid;
    }
}
