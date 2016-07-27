<?php
namespace frontend\controllers;

use common\models\Article;
use common\models\Banner;
use common\models\Feedback;
use common\models\Product;
use common\models\Slider;
use common\models\Subscribe;
use common\models\User;
use Yii;
use frontend\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\authclient\AuthAction;


class SiteController extends Controller
{
    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            Url::remember();
            return true;
        } else {
            return false;
        }
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'auth' => [
                'class' => AuthAction::className(),
                'successCallback' => [$this, 'successCallback'],
                'successUrl' => '/user/index',
            ],
        ];
    }

    public function actionIndex()
    {
        $slides = Slider::find()->where(['is_published' => '1'])->orderBy('sort_index')->all();

        $services = Article::find()->where(['is_published' => '1', 'category_id' => '2'])->limit(4)->all();

        $certificates = Banner::find()->where(['is_published' => '1', 'type_id' => '1'])->all();
        
        $partners = Banner::find()->where(['is_published' => '1', 'type_id' => '2'])->all();

        $products = Product::find()->where(['is_published' => '1'])->orderBy('created DESC')->all();

        return $this->render('index', [
            'slides' => $slides,
            'services' => $services,
            'certificates' => $certificates,
            'partners' => $partners,
            'products' => $products
        ]);
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
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

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new Feedback();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->status = 1;
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Спасибо. Письмо отправлено.');
            } else {
                Yii::$app->session->setFlash('error', 'Произошла ошибка.');
            }
            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionCallback()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Спасибо. Письмо отправлено.');
            } else {
                Yii::$app->session->setFlash('error', 'Произошла ошибка.');
            }

            return $this->refresh();
        } else {
            return $this->render('callback', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    Yii::$app->getSession()->setFlash('success', 'Вы успешно зарегистрировались.');
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', 'Проветьте свою почту и следуйте инструкциям.');

                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionSubscribe()
    {
        $model = new Subscribe();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('success', 'Вы успешно подписались.');
            return $this->goHome();
        } else{
            Yii::$app->getSession()->setFlash('error', 'Произошла ошибка. Такой email уже существует');
            return $this->goHome();
        }
    }

    public function successCallback($client)
    {
        $attributes = $client->getUserAttributes();

        $model = new SignupForm();
        $model->scenario = 'social';

        if($client->getName() == 'vkontakte'){

            $accessToken = $client->getAccessToken();
            $email = isset($accessToken->params['email']) ? $accessToken->params['email'] : '';

            $model->email = $email;
            $model->vk_id = (string)$attributes['id'];
            $model->firstname = $attributes['first_name'];
            $model->lastname = $attributes['last_name'];
            $model->sex = $attributes['sex'] - 1;
            $model->birthday = Yii::$app->formatter->asDate($attributes['bdate'], 'php: Y-m-d');

            $user = User::find()->where(['vk_id' => $attributes['id']])->one();

        } else if($client->getName() == 'facebook'){

            $email = isset($attributes['email']) ? $attributes['email'] : '';

            $model->email = $email;
            $model->fb_id = $attributes['id'];
            $model->firstname = $attributes['first_name'];
            $model->lastname = $attributes['last_name'];
            $model->sex = ($attributes['gender'] == 'female') ? 0 : 1;

            $user = User::find()->where(['fb_id' => $attributes['id']])->one();
        }

        else if($client->getName() == 'twitter'){

            $email = '';

            $model->email = $email;
            $model->tw_id = $attributes['id'];
            $model->firstname = $attributes['name'];
            $model->lastname = '';

            $user = User::find()->where(['tw_id' => $attributes['id']])->one();
        }




        if($user){
            Yii::$app->getUser()->login($user);
            Yii::$app->getSession()->setFlash('success', 'Вы успешно вошли.');
        }else {
            if($email && $user = User::find()->where(['email' => $email])->one()){

                $user->scenario = 'social';

                if($client->getName() == 'vkontakte'){
                    $user->vk_id = (string)$attributes['id'];
                }

                else if($client->getName() == 'facebook'){
                    $user->fb_id = $attributes['id'];
                }

                else if($client->getName() == 'google'){
                    $user->gg_id = $attributes['id'];
                }

                else if($client->getName() == 'linkedin'){
                    $user->li_id = $attributes['id'];
                }

                else if($client->getName() == 'mailru'){
                    $user->mr_id = $attributes['id'];
                }

                else if($client->getName() == 'odnoklassniki'){
                    $user->ok_id = $attributes['id'];
                }
                else if($client->getName() == 'twitter'){
                    $user->tw_id = $attributes['id'];
                }

                $user->save();

                Yii::$app->getUser()->login($user);
                Yii::$app->getSession()->setFlash('success', 'Вы успешно вошли.');

            } else{


                if($user = $model->signupSocial()){
                    if (Yii::$app->getUser()->login($user)) {
                        Yii::$app->getSession()->setFlash('success', 'Вы успешно зарегестрировались.');
                    }
                }
            }
        }
    }
}
