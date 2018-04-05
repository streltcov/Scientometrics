<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);

?>

<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>

    <body>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>


    <?php $this->beginBody() ?>

    <div class="wrap">
        <?php
        NavBar::begin([
            'brandLabel' => '<b class="navbrand">'.'Наукометрия'.'</b>',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
                'style' => 'background-color: #2a323b; box-shadow: 0 0 1pc;'
            ],
        ]);
        echo Nav::widget([
            'options' => [
                'class' => 'navbar-nav navbar-right',
            ],
            'encodeLabels' => false,
            'items' => [
                ['label' => "<input style='height: 1.5pc; color: #fff; background-color: #2c3337;' placeholder='Поиск' class=\"form-control\" type=\"text\"></input>"],
                /*['label' => 'Develop' ,
                    'visible' => !Yii::$app->user->isGuest,
                    'items' => [
                        ['label' => 'control', 'url' => ['/control']],
                        ['label' => 'Users', 'url' => ['/control/users']],
                        ['label' => 'Test', 'url' => ['/test']],
                        ['label' => 'Articles', 'url' => ['/control/articles']],
                        ['label' => 'Articles indexes', 'url' => ['/control/indexes']]
                    ]
                ],*/
                ['label' => 'Публичные данные',
                    'items' => [
                        ['label' => 'Публикации', 'url' => ['/public/items'], 'options' => [
                            'style' => 'width: 20pc;'
                        ]]
                    ]
                ],
                ['label' => 'Обратная связь', 'url' => ['/site/contact']],
                Yii::$app->user->isGuest ? (
                ['label' => 'Войти', 'url' => ['/site/login']]
                ) : (
                [
                    'label' => "<span class=\"glyphicon glyphicon-list\"></span>",
                    'items' => [
                        ['label' => 'Панель управления', 'url' => ['/control'], 'options' => [
                            'style' => 'width: 20pc;'
                        ]],
                        ['label' => 'Личный кабинет', 'url' => ['/control/user/', 'id' => Yii::$app->user->id]],
                        //'<br>',
                        '<li class="divider"></li>',
                        ['label' => 'Вы вошли как:'],
                        ['label' => "<b style=\"color: #32a873\">".' '.Yii::$app->user->identity->name.' '.Yii::$app->user->identity->lastname.'</b>'],
                        ['label' => '<b>'.Yii::$app->user->identity->username.'</b>'],
                        '<br>',
                        '<li class="divider"></li>',
                        ['label' => 'Выход', 'url' => ['/site/logout'], 'linkOptions' => [
                            'data-method' => 'post'
                        ]]
                        /*Html::a('Exit', ['/site/logout'])]*/
                    ]
                ]
                ),
            ],
        ]);
        NavBar::end();
        ?>



        <br>
        <br>
        <br>

        <div style="background-color: white;" class="container">
            <div class="row">
                <div class="col-xs-12 col-md-3">
                    <br>
                    <div id="main-menu" class="list-group">
                        <br>
                        <br>
                        <!--<a href="/control" class="list-group-item">Панель управления</a>-->
                        <?= Html::a('Панель управления', '/control', ['class' => 'list-group-item']); ?>
                        <a href="#sub-menu" class="list-group-item" data-toggle="collapse" data-parent="#main-menu">Авторы и сотрудники<span class="caret"></span></a>
                        <div class="collapse list-group-level1" id="sub-menu">
                            <a href="/control/users" class="list-group-item" data-parent="#sub-menu">Зарегистрированные пользователи</a>
                            <a href="/control/authors" class="list-group-item" data-parent="#sub-menu">Авторы</a>
                            <a href="/control/personnel" class="list-group-item" data-parent="#sub-menu">Сотрудники</a>
                            <a href="#sub-sub-menu" class="list-group-item" data-toggle="collapse" data-parent="#sub-menu">Sub Item 3 <span class="caret"></span></a>
                            <div class="collapse list-group-level2" id="sub-sub-menu">
                                <a href="#" class="list-group-item" data-parent="#sub-sub-menu">Sub Sub Item 1</a>
                                <a href="#" class="list-group-item" data-parent="#sub-sub-menu">Sub Sub Item 2</a>
                                <a href="#" class="list-group-item" data-parent="#sub-sub-menu">Sub Sub Item 3</a>
                            </div>
                        </div>
                        <a href="#sub-menu2" class="list-group-item" data-toggle="collapse" data-parent="#main-menu">Публикации <span class="caret"></span></a>
                        <div class="collapse list-group-level1" id="sub-menu2">
                            <a href="/control/articles" class="list-group-item" data-parent="#sub-menu2">Опубликованные статьи</a>
                            <a href="/control/monographies" class="list-group-item" data-parent="#sub-menu2">Монографии</a>
                            <!--<a href="/control/personnel" class="list-group-item" data-parent="#sub-menu">Сотрудники</a>-->
                        </div>
                        <a href="/control/events" class="list-group-item">Научные мероприятия <span class="caret"></span></a>
                        <a href="/control/messages" class="list-group-item">Сообщения
                            <?php
                            $count = \app\modules\Control\models\Messages::find()->count();
                            if ($count > 0) {
                                echo "<span class=\"badge badge-light\">".$count."</span>";
                            }
                            ?>
                        </a>
                    </div>
                </div>
                <div class="col-xs-12 col-md-9">
                    <br>
                    <?php
                    //\yii\helpers\VarDumper::dump($this->params);
                    ?>

                    <?= Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        ]) ?>

                    <?= Alert::widget() ?>

                    <?= $content ?>
                </div>
            </div>
        </div>
    </div>

    <footer style="color: #2a323b; height: 2.5pc; background-color: #d2d4d9;" class="navbar-fixed-bottom ">
        <div class="container">
            <p style="margin-top: 0.5pc;">
                <b class="pull-left">&copy;  <?= date('Y') ?></b>

                <b class="pull-right"><?= Yii::powered() ?></b>
            </p>
            <br>
        </div>
    </footer>

    <?php yii\helpers\Url::remember(); ?>

    <script>
        $(document).ready(function() {
            $("body").niceScroll().resize(25);
        });
    </script>

    <?php $this->endBody() ?>

    </body>

    </html>

<?php $this->endPage() ?>