<?php
/**
 * @var $this \yii\web\View
 * @var $services array
 */


use App\App;
use App\Helpers\Url;

$data = ["features" => [
    [
        "digital" => "14+",
        "title" => "лет практики",
        "description" => "Более 14 лет занимаемся содействием в оформлении докуметов для получения медицинской лицензии.",
    ],
    [
        "digital" => "500+",
        "title" => "пакетов документации",
        "description" => "В период с 2010 по 2020 год мы оформили более 500 пакетов соответствующей документации, из них 100% были успешно использованы для лицензирования.",
    ],
    [
        "digital" => "50+",
        "title" => "постоянных клиентов",
        "description" => "За текущий год более 50 клиентов, обратились повторно для дальнейшего консалтинга в области медицинского лицензирования.",
    ],
]];
?>

<script>
    document.body.classList.add('bg-accent');
</script>

<section class="section section-main bg-overlay">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-12 col-md-12">
                <div class="section-content">
                    <div class="section-content__wrapper">
                        <div class="w-100 text-center max-w-700 mb-30">
                            <h1 class="headers-h1">Выбери кратчайший путь к&nbsp;своей лицензии!</h1>
                            <h2 class="headers-h2 c-accent__super-lightest">
                                Лучшие консультации по медицинскому и фармацевтическому лицензированию.
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section section-person">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8 col-sm-12 col-md-12">
                <div class="section-content">
                    <div class="section-content__wrapper">
                        <p class="dr-text__normal c-accent__darker opacity-7">Уважаемые коллеги и гости сайта! Меня зовут Малярова Вероника Анатольевна. Я сертифицированный Росздравнадзором эксперт в сфере лицензирования медицинской и фармацевтической деятельности.
                            <br>
                            <br>
                            Занимаясь последние 15 лет медицинским лицензированием и вопросами, связанными с работой органов Роспотребнадзора, мне как бывшему сотруднику СЭС и врачу, имевшему свой собственный медицинский бизнес, стало очевидно, что несмотря на то, что я имею высокий уровень компетенции и знаний в своем деле, я не могу помочь большому количеству людей. Во многом это обусловлено тем, что много времени уходит на индивидуальную работу с отдельно взятым клиентом. Такая углубленность позволяет со 100% вероятностью гарантировать получение клиентом медицинской лицензии, но в то же время не дает возможности помочь тем, у кого ограничен бюджет. Стоимость консультационных услуг в этой сфере достаточно высока и не все обратившиеся ко мне могут себе позволить тратить такие средства. Поэтому, значительная часть клиентов в попытке сэкономить, пытаются самостоятельно искать информацию по медицинскому и фармацевтическому лицензированию, что в большинстве случаев не приносит желаемых результатов.
                            <br>
                            <br>
                            Пришло время это изменить! Как говорят, «не было бы счастья, да несчастье помогло» - пандемия короновируса Covid-19 заставила многих, в том числе и меня, пересмотреть свои подходы к дистанционной работе. После года кропотливого сбора и систематизации всей, имеющейся у меня информации, я с гордостью могу утверждать, что этот сайт может помочь каждому желающему получить медицинскую или фармацевтическую лицензию. Все, что необходимо соискателю лицензии это внимательно усвоить информацию, размещенную здесь и сейчас! Добро пожаловать и удачи! :)</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 col-sm-12 col-md-12">
                <div class="section-image">

                    <img src="images/_src/person.png" alt="">
                    <p class="label-photo dr-text__small">
                        <span>Малярова</span>
                        <span>Вероника Анатольевна</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section section-image-content">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-4 col-md-4 col-sm-12">
                <div class="section-image mr-40">
                    <img src="images/_src/frame-15.svg" class="max-w-400" alt="">
                </div>
            </div>
            <div class="col-12 col-lg-8 col-md-8 col-sm-12">
                <div class="section-content align-items-start">
                    <div class="section-content__wrapper">
                        <h3 class="headers-h2 c-accent__darken mb-20">Почему мне можно доверять?</h3>
                        <ul class="list-content list-content__arrow opacity-7">
                            <li class="dr-text__normal c-accent__darker">Имею профильное образование РостГМУ, два высших медицинских образования — медико-профилактический и лечебный факультеты.</li>
                            <li class="dr-text__normal c-accent__darker">Работала в центре Госсанэпиднадзора г. Ростова-на-Дону врачом-эпидемиологом, с 2005 года занимаюсь вопросами медицинского лицензирования.</li>
                            <li class="dr-text__normal c-accent__darker">В 2008 году прошла обучение в ФГУ «Консультативно-методическом центре Росздравнадзора» и получила сертификат «Эксперта по лицензированию и стандартизации в сфере здравоохранения», и на данный момент являюсь единственным независимым специалистом в Ростове-на-Дону, работающим в сфере консалтинга в области медицинского лицензирования.</li>
                            <li class="dr-text__normal c-accent__darker">С 2013 года являюсь совладельцем Клиники лазерной косметологии, оказываю услуги консалтинга и готовлю документы для лицензиатов Ростова-на-Дону и Ростовской области.</li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="section section-feature-content bg-accent bg-overlay">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8 col-md-8 col-sm-12">
                <div class="section-content align-items-start">
                    <div class="section-content__wrapper">
                        <p class="dr-text__normal">
                            Перед тем как непосредственно перейти к вопросам, связанным с получением лицензии, я хотела бы затронуть моменты, которые не всегда очевидны и понятны будущим лицензиатам. Те моменты, которые станут ключевыми для вас сразу после того, как вы получите такую желаемую вами медицинскую лицензию! Ведь одно дело хотеть, а другое дело получить желаемое.. Помните Булгакова? «Бойтесь своих желаний - они имеют свойство сбываться!»
                            <br><br>
                            Задайте себе простой, но очень важный вопрос – а нужно ли мне все это?
                            <br><br>
                            Сколько частных медицинских учреждений уже открыто и сколько еще откроется? Будут ли у вас возможности и силы конкурировать с ними? Сможете ли вы качественно оказывать услуги населению и при этом быть организатором лечебного процесса? Есть ли у вас достаточные финансовые ресурсы для становления бизнеса в постоянно меняющихся условиях стагнирующей экономики? Готовы ли вы терпеть жалобы «неблагодарных» пациентов в разные инстанции и проходить через последующие за этим проверки? Есть ли у вас покровители, которые смогут защищать вас и ваш бизнес от произвола чиновников?
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 col-md-4 col-sm-12">
                <div class="section-image mr-40">
                    <img src="images/_src/frame-16.svg" class="max-w-400" alt="">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-4 col-md-4 col-sm-12">
                <div class="section-image mr-40">
                    <img src="images/_src/frame-17.svg" class="max-w-400" alt="">
                </div>
            </div>
            <div class="col-12 col-lg-8 col-md-8 col-sm-12">
                <div class="section-content align-items-start">
                    <div class="section-content__wrapper">
                        <p class="dr-text__normal">
                            Поймите меня правильно. После очень большого количества консультаций и не меньшего количества полученных для моих клиентов лицензий я поняла одно. Люди совершенно не представляют сложностей ведения медицинского бизнеса. Половина лицензиатов прекращают свою деятельность в первый же год. Другие, хотя и продолжают работу, но буквально находятся на грани выживания. Аренда, кредиты, проверки, сложности с пациентами – все это превращает их жизнь в каторгу. И еще вчера любимая работа становится ненавистной.
                            <br><br>
                            Не могу не упомянуть, что во время моего первоначального очного консультирования я стараюсь донести эти мысли до своих клиентов, и некоторые из них в последующем сообщают мне, что решили не вкладываться в открытие медицинского кабинета, так как прислушались к моим доводам. Для меня это тоже важно. Я считаю, что частной медициной должны заниматься профессионалы-энтузиасты, имеющие ресурсы и волю довести свои планы до полной реализации. Те же, кто вовремя передумали благодарят меня за сэкономленные время и деньги. Для них наверняка жизнь предоставит совсем другие возможности. Подумайте и вы над этим!
                            <br><br>
                            А теперь, давайте вернемся к лицензированию!)
                        </p>
                        <a href="<?=Url::toRoute(['site/license-page'])?>" class="dr-btn dr-btn__orange-gradient ml-0">Перейти в раздел «лицензионное дело»</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="section section-service">
    <div class="container">
        <h2 class="headers-h2 section-title c-accent__darker opacity-7">Разделы сайта</h2>
        <p class="dr-text__normal c-accent__darker max-w-820 ml-0 opacity-7">Разделы сайта мы структурировали таким образом, чтобы вы пошагово следовали нашим рекомендациям и выполняли все ваши действия в той последовательности, которая сможет вас уберечь от потери времени и денег, и сделать ваш путь к лицензии наикратчайшим.</p>

        <?php echo $this->render( 'template-parts/service-list', ['services' => $services]); ?>

        <p class="dr-text__normal c-accent__darker opacity-7">Сайт является коммерческим проектом. Для работы с основной информацией сайта вам потребуется регистрация аккаунта. Некоторые разделы являются платными и не будут доступны без оплаты.</p>
    </div>
</section>

<?php if(!App::i()->getCurrentUser()):?>
<section class="section section-main-cta">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex flex-column justify-content-center max-w-400">
                    <h2 class="headers-h2 c-accent__darken text-center section-title">Начните прямо сейчас!</h2>
                    <a href="<?=Url::toRoute(['auth/registration'])?>" class="dr-btn dr-btn__orange-gradient">зарегистрируйтесь</a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif;?>

<section class="section section-features bg-overlay">
    <div class="container">
        <h2 class="headers-h2 text-center section-title">Почему нам можно доверять</h2>
        <div class="features-list">
            <div class="row">
                <?php foreach($data['features'] as $item) : ?>
                    <div class="col-12 col-md-12 col-lg-4">
                        <div class="features-list__item">
                            <p class="features-list__main c-accent__lightest">
                                <span class="features-list__digital big-digital"><?=$item['digital']; ?></span>
                                <span class="headers-h3 features-list__title"><?=$item['title']; ?></span>
                            </p>
                            <p class="dr-text__normal features-list__description"><?=$item['description']; ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="d-flex flex-column justify-content-center max-w-400 mt-30">
                        <a href="<?=Url::toRoute('review/index')?>" class="dr-btn dr-btn__outline">наши клиенты и отзывы</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

