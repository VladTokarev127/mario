<?php
/*
Template Name: Главная
*/
get_header();
$userID = get_current_user_id();
$userScore = get_the_author_meta('user_score', $userID);
$userScoreText = empty($userScore) ? 'Пока нет' : number_format($userScore, 0, '.', ' ');
?>

	<div class="content-wrapper">
		<main class="main">
		<div class="main-wrapper-home">
		    <h1><?php the_title(); ?></h1>
		    <p>Вам доступен любой из 32 уровней или сгенерировать случайную карту. Наслаждайтесь графикой из денди 1985-1990 годов!</p>
		    <div class="homedesc">
		    <p>Используйте клавиши <strong>W, A, S, D</strong> или стрелки <strong>[↑ → ↓ ←]</strong> для управления Марио, чтобы прыгнуть выше удерживайте кнопку.</p>
		    <p>Используйте <strong>Shift</strong> и <strong>CTRL</strong> чтобы стрелять и бежать быстрее. <strong>P</strong> - пауза, <strong>M</strong> - выключить звук <?php $iPod    = stripos($_SERVER['HTTP_USER_AGENT'],"iPod"); $iPhone  = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone"); $iPad    = stripos($_SERVER['HTTP_USER_AGENT'],"iPad"); $Android = stripos($_SERVER['HTTP_USER_AGENT'],"Android"); if( $iPod || $iPhone || $iPad ){ echo "ios"; }else if($Android){ echo "android"; }?>.</p>
		    </div>
		</div>

            <div class="main-info">
                
		<?php if ( is_user_logged_in() ) { ?>

                <div class="main-info__nav main-info__nav--desktop">
                    <div class="main-info__nav-left">
                        <a href="/user/<?php $display_name = um_user('user_login'); echo $display_name; ?>">
                        <div class="main-info__nav-avatar">
                            <div class="main-info__nav-avatar__image">
                                <?php $display_name = um_user('profile_photo', 64); echo $display_name; ?>
                            </div>
                            <div class="main-info__nav-avatar__name">
                                <p><?php $display_name = um_user('first_name'); echo $display_name; ?> <?php $display_name = um_user('last_name'); echo $display_name; ?></p>
                                <span>@<?php $display_name = um_user('user_login'); echo $display_name; ?> • <?php echo um_profile_id(); ?></span>
                            </div>
                        </div>
                        </a>
                        <div class="main-info__nav-text-wrap">
                            <p class="main-info__nav-text">Ваши очки: <b><?php echo $userScoreText; ?></b></p>
                            <p class="main-info__nav-text">Место в рейтинге: <b>100</b></p>
                        </div>
                    </div>
                    <div class="main-info__nav-buttons">
                        <button type="button" class="main-info__nav-btn main-info__nav-btn--green js-startmario">Играть</button>
                        <button type="button" class="main-info__nav-btn main-info__nav-btn--red js-stopmario" style="display:none;">Завершить игру</button>
                        <button type="button" class="main-info__nav-btn main-info__nav-btn--pause js-pausemario" style="display:none;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#8c8c8c" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-pause-circle"><circle cx="12" cy="12" r="10"/><line x1="10" y1="15" x2="10" y2="9"/><line x1="14" y1="15" x2="14" y2="9"/></svg>
                            Пауза
                        </button>
                        <button type="button" class="main-info__nav-btn main-info__nav-btn--start js-unpausemario" style="display:none;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ff9800" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-play-circle"><circle cx="12" cy="12" r="10"/><polygon points="10 8 16 12 10 16 10 8"/></svg>
                            Старт
                        </button>
                        <!-- Когда турнир не проводится, кнопка серая -->
                        <button type="button" class="main-info__nav-btn main-info__nav-btn--grey no-tourney" style="display:none;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none">
                            <path d="M20.9902 3.4995H17.9909V2.49975C17.9909 2.2346 17.8856 1.98031 17.6981 1.79282C17.5106 1.60533 17.2563 1.5 16.9912 1.5H6.99368C6.72853 1.5 6.47424 1.60533 6.28675 1.79282C6.09926 1.98031 5.99393 2.2346 5.99393 2.49975V3.4995H2.99468C2.72953 3.4995 2.47524 3.60483 2.28775 3.79232C2.10026 3.97981 1.99493 4.2341 1.99493 4.49925V7.4985C1.99493 11.8074 3.79348 14.4068 6.81273 14.5087C7.25473 15.2684 7.85821 15.9216 8.58051 16.4222C9.30281 16.9229 10.1263 17.2587 10.9927 17.406V19.4955H8.99318V21.495H14.9917V19.4955H12.9922V17.406C13.8584 17.2581 14.6816 16.922 15.4038 16.4215C16.126 15.9209 16.7297 15.268 17.1721 14.5087C20.1914 14.4068 21.9899 11.8074 21.9899 7.4985V4.49925C21.9899 4.2341 21.8846 3.97981 21.6971 3.79232C21.5096 3.60483 21.2553 3.4995 20.9902 3.4995ZM3.99443 7.4985V5.499H5.99393V12.3273C4.21038 11.5755 3.99443 8.79717 3.99443 7.4985ZM11.9924 15.4965C9.78699 15.4965 7.99343 13.7029 7.99343 11.4975V3.4995H15.9914V11.4975C15.9914 13.7029 14.1979 15.4965 11.9924 15.4965ZM17.9909 12.3273V5.499H19.9904V7.4985C19.9904 8.79717 19.7745 11.5755 17.9909 12.3273Z" fill="#6B6B6B"/>
                            </svg>
                            Турнир
                        </button>
                        <!-- Конец кнопка серая -->
                        <button type="button" class="tournament main-info__nav-btn main-info__nav-btn--blue js-starttourney">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none">
                            <path d="M20.9902 3.4995H17.9909V2.49975C17.9909 2.2346 17.8856 1.98031 17.6981 1.79282C17.5106 1.60533 17.2563 1.5 16.9912 1.5H6.99368C6.72853 1.5 6.47424 1.60533 6.28675 1.79282C6.09926 1.98031 5.99393 2.2346 5.99393 2.49975V3.4995H2.99468C2.72953 3.4995 2.47524 3.60483 2.28775 3.79232C2.10026 3.97981 1.99493 4.2341 1.99493 4.49925V7.4985C1.99493 11.8074 3.79348 14.4068 6.81273 14.5087C7.25473 15.2684 7.85821 15.9216 8.58051 16.4222C9.30281 16.9229 10.1263 17.2587 10.9927 17.406V19.4955H8.99318V21.495H14.9917V19.4955H12.9922V17.406C13.8584 17.2581 14.6816 16.922 15.4038 16.4215C16.126 15.9209 16.7297 15.268 17.1721 14.5087C20.1914 14.4068 21.9899 11.8074 21.9899 7.4985V4.49925C21.9899 4.2341 21.8846 3.97981 21.6971 3.79232C21.5096 3.60483 21.2553 3.4995 20.9902 3.4995V3.4995ZM3.99443 7.4985V5.499H5.99393V12.3273C4.21038 11.5755 3.99443 8.79717 3.99443 7.4985ZM11.9924 15.4965C9.78699 15.4965 7.99343 13.7029 7.99343 11.4975V3.4995H15.9914V11.4975C15.9914 13.7029 14.1979 15.4965 11.9924 15.4965ZM17.9909 12.3273V5.499H19.9904V7.4985C19.9904 8.79717 19.7745 11.5755 17.9909 12.3273Z" fill="white"/>
                            </svg>
                            Турнир
                        </button>
                        <button type="button" class="tournament main-info__nav-btn main-info__nav-btn--red js-stoptourney"  style="display:none;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none">
                            <path d="M20.9902 3.4995H17.9909V2.49975C17.9909 2.2346 17.8856 1.98031 17.6981 1.79282C17.5106 1.60533 17.2563 1.5 16.9912 1.5H6.99368C6.72853 1.5 6.47424 1.60533 6.28675 1.79282C6.09926 1.98031 5.99393 2.2346 5.99393 2.49975V3.4995H2.99468C2.72953 3.4995 2.47524 3.60483 2.28775 3.79232C2.10026 3.97981 1.99493 4.2341 1.99493 4.49925V7.4985C1.99493 11.8074 3.79348 14.4068 6.81273 14.5087C7.25473 15.2684 7.85821 15.9216 8.58051 16.4222C9.30281 16.9229 10.1263 17.2587 10.9927 17.406V19.4955H8.99318V21.495H14.9917V19.4955H12.9922V17.406C13.8584 17.2581 14.6816 16.922 15.4038 16.4215C16.126 15.9209 16.7297 15.268 17.1721 14.5087C20.1914 14.4068 21.9899 11.8074 21.9899 7.4985V4.49925C21.9899 4.2341 21.8846 3.97981 21.6971 3.79232C21.5096 3.60483 21.2553 3.4995 20.9902 3.4995V3.4995ZM3.99443 7.4985V5.499H5.99393V12.3273C4.21038 11.5755 3.99443 8.79717 3.99443 7.4985ZM11.9924 15.4965C9.78699 15.4965 7.99343 13.7029 7.99343 11.4975V3.4995H15.9914V11.4975C15.9914 13.7029 14.1979 15.4965 11.9924 15.4965ZM17.9909 12.3273V5.499H19.9904V7.4985C19.9904 8.79717 19.7745 11.5755 17.9909 12.3273Z" fill="white"/>
                            </svg>
                            Завершить турнир
                        </button>
                    </div>
                </div>

                <div class="main-info__nav main-info__nav--mobile">
                    <div class="main-info__nav-left">
                        <div class="main-info__nav-avatar">
                            <div class="main-info__nav-avatar__image">
                                <?php $display_name = um_user('profile_photo', 64); echo $display_name; ?>
                            </div>
                            <div class="main-info__nav-avatar__name">
                                <p><?php $display_name = um_user('first_name'); echo $display_name; ?></p>
                                <span>@<?php $display_name = um_user('user_login'); echo $display_name; ?></span>
                            </div>
                        </div>
                        <div class="main-info__nav-text-wrap">
                            <p class="main-info__nav-text">Очки: <b><?php echo $userScoreText; ?></b></p>
                            <p class="main-info__nav-text">Рейтинг: <b>10</b></p>
                        </div>
                    </div>
                    <div class="main-info__nav-buttons">
                        <button type="button" class="main-info__nav-btn main-info__nav-btn--green js-startmario">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M10 8L16 12L10 16V8Z" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                        <button type="button" class="main-info__nav-btn main-info__nav-btn--red js-stopmario" style="display:none;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/>
                            </svg>
                        </button>
                        <button type="button" class="main-info__nav-btn main-info__nav-btn--pause js-pausemario" style="display:none;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#8c8c8c" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-pause-circle"><circle cx="12" cy="12" r="10"/><line x1="10" y1="15" x2="10" y2="9"/><line x1="14" y1="15" x2="14" y2="9"/>
                            </svg>
                        </button>
                        <button type="button" class="main-info__nav-btn main-info__nav-btn--start js-unpausemario" style="display:none;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ff9800" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-play-circle"><circle cx="12" cy="12" r="10"/><polygon points="10 8 16 12 10 16 10 8"/></svg>
                        </button>
                    </div>
                </div>

        <?php } else { ?>
                <div class="main-info__warning">
                    <p class="main-info__warning-text">Чтобы попасть в таблицу рейтинга или участвовать в турнире <a href="/login">войдите</a>&nbsp;или&nbsp;<a href="/registration">зарегистрируйтесь</a>.</p>
                </div>
        <?php } ?>
                


            </div>
		
		<div class="gameframe">
				<!-- Это нужные стили и js файлы для работы -->
				
 <script src="/mario-game/popper.min.js"></script>
    <script>
        var is_mobile = false;
        var is_fullscreen = false;
        var is_dev = false;
    </script>

    <style>
        body {
            font-size: calc(14px + (16 - 14) * ((100vw - 300px) / (1600 - 300)));
        }
        .layout {
            max-width: 960px;
        }
        @media screen and (max-width: 425px) {
            .layout {
                width: 90% !important;
            }
        }
        .description {
            margin-top: 50px !important;
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0px 15px 25px 0px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(0, 0, 0, 0.15);
            border-bottom-color: rgba(0, 0, 0, 0.5);
            border-bottom-width: 5px;
        }
        .lang-modal {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
        }
        .lang-modal .link {
            display: inline-block;
            padding: 5px;
        }
        .fluid-heading {
            font-size: 1.8rem;
        }
        @media screen and (max-width: 425px) {
            .description img {
                width: 100%;
                float: none !important;
                box-sizing: border-box;
                display: block;
                margin: 0 !important;
            }
        }
        .language-list.show {
            display: grid !important;
            grid-template-columns: 1fr 1fr 1fr;
        }
        @media screen and (max-width: 425px) {
            .language-list.show {
                grid-template-columns: 1fr 1fr;
            }
        }
        .topbar__heading {
            margin-right: 1rem;
            text-align: center;
        }
        @media screen and (max-width: 770px) {
            .topbar {
                flex-direction: column;
            }
            .topbar__heading {
                margin-right: 0;
            }
        }
        .change-lang {
            display: flex;
            align-items: center;
            justify-content: center;
            text-transform: capitalize;
            margin: 1rem;
        }
        .change-lang:hover {
            text-decoration: none;
        }
        .change-lang .flag-icon {
            margin-right: 5px;
            transform: translateY(1px);
        }

        @media screen and (max-width: 1270px) {
            .dropdown { position: static ;}
        }
        .topbar__heading {
            width: 100%;
            text-align: center;
        }
        .topbar .dropdown {
            float: right;
            min-width: max-content;
        }
        header .d-flex {
            flex-direction: column;
        }
        @media all and (max-width: 540px) {
            .fluid-heading {
                font-size: 1.6rem;
            }
            body.mt-2 {
                margin-top: 0 !important;
            }
            .layout.pt-5 {
                padding-top: 15px !important;
            }
            .change-lang {
                margin: 0 1rem;
            }
            header div p {
                line-height: 1.2;
                margin-top: 8px !important;
                margin-bottom: 5px !important;
            }
            #runner.mb-5.pb-5 {
                padding-bottom: 0 !important;
                margin-bottom: 30px !important;
            }
        }
        .main-menu {
            width: 100%;
            text-align: center;
            font-weight: 600;
        }

        .main-menu .divider {
            display: inline-block;
            width: 10px;
            position: relative;
            height: 12px;
            margin: 0 10px;
        }

        .main-menu .divider:after {
            content: '';
            display: block;
            width: 10px;
            height: 2px;
            background-color: #212529;
            position: absolute;
            left: 0;
            top: 5px;
        }

        .main-menu a {
            color: #212529;
        }
        .bd-placeholder-img {
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 200px;
        }

        .bd-placeholder-img.mob {
            height: 450px;
        }

        .card-text {
            color: #212529;
        }
        .card {
            margin-bottom: 15px;
        }

        @media all and (max-width: 540px) {
            .bd-placeholder-img {
                height: 150px;
            }

            .bd-placeholder-img.mob {
                height: 320px;
            }
        }

        @font-face {
            font-family: 'Press Start';
            src: url('/mario-game/Fonts/pressstart2p-webfont.eot');
            src: url('/mario-game/Fonts/pressstart2p-webfont-1.eot') format('embedded-opentype'), url('/mario-game/Fonts/pressstart2p-webfont.woff') format('woff'), url('/mario-game/Fonts/pressstart2p-webfont.ttf') format('truetype'), url('/mario-game/Fonts/pressstart2p-webfont.svg') format('svg');
            font-weight: normal;
            font-style: normal;
            font-display: swap;
        }

        @font-face {
            font-family: 'Super Plumber Bros';
            src: url('/mario-game/Fonts/super_plumber_brothers-webfont.eot');
            src: url('/mario-game/Fonts/super_plumber_brothers-webfont-1.eot') format('embedded-opentype'), url('/mario-game/Fonts/super_plumber_brothers-webfont.woff') format('woff'), url('/mario-game/Fonts/super_plumber_brothers-webfont.ttf') format('truetype'), url('/mario-game/Fonts/super_plumber_brothers-webfont.svg') format('svg');
            font-weight: normal;
            font-style: normal;
            font-display: swap;
        }

        #game {
    background: #000;
    display: block;
    width: 100%;
    max-width: 1300px;
    height: 509px;
    position: relative;
    margin: 0px 0px 10px auto;
    border: 1px solid #ffffff;
    border-radius: 8px;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
        }

        #game.mobilegame {
            border: none;
            max-width: 848px;
            height: 528px;
        }

        body.fullscreen {
            background-color: #000;
        }

        body.fullscreen #main {
            max-width: 100%;
        }

        body.fullscreen #game {
            max-width: 100%;
            height: 500px;
            border: none;
            position: static;
            margin: 0;
        }

        body.fullscreen #out_editor {
            position: static;
        }

        body.fullscreen #sound-toggle {
            width: 200px;
            position: static;
            margin: 10px auto;
        }

        body.fullscreen #out_mapselect {
            position: static;
        }

        body.fullscreen #go-back {
            position: static;
        }

        body.fullscreen #go-back a {
            color: #fff;
            text-decoration: none;
        }

        #after {
            margin: 0 0 26px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 21px;font-family: "Press Start";text-transform: uppercase;line-height: 117%;
        }

        .bar1 {
            cursor: pointer;
            margin: 10px;
            text-align: center;
        }

        #out_editor {
        }

        #out_mapselect {
            color: #000;
        }

        #out_options {
        }

        #in_editor {
            color: #000;
        }

        #out_keymapping {
            margin: 7px auto;
        }

        #in_options {
        }

        #sound-toggle {
            color: #000;
        }

        #sound-toggle:hover {
            color: #a6ec5e;
        }

        #full-screen a {
            color: #000;
            text-decoration: none;
        }

        #full-screen a:hover {
            color: #a6ec5e;
        }

        #in_keymapping:hover {
            height: 400px;
        }

        #in_keymapping input {
            width: 80px;
            margin-right: 20px;
            float: right;
            font-family: "Press Start";
            text-transform: uppercase;
        }

        #in_keymapping input:focus {
            background-color: #0099ff;
        }

        .expander {
            padding: 7px;
            width: 280px;
            height: 24px;
            display: none;
            z-index: 98;
            background: #009966;
            border: 3px solid #99ffcc;
            border-radius: 7px;
            box-shadow: 0 3px 7px black inset;
            font-size: 14px;
            margin: 0 10px;
            position: absolute;
        }

        .bar1:hover .expander {
            margin-top: -294px;
            height: 280px;
            display: block;
        }

        .bar1 div.label {
            margin: 0;
            font-size: 14px;
        }

        .maprectout {
            margin: 1px 3px;
            display: inline-block;
            background: #ffcc33;
            border: 3px outset;
            cursor: pointer;
            color: black;
            font-size: 14px;
        }

        .maprect {
            width: 49px;
            height: 20px;
        }

        .maprect.off {
            background: #996600;
        }

        .maprect.big {
            width: 231px;
        }

        .maprect.larger {
            margin: 14px 0;
        }

        .maprect.giant {
            padding: 28px 0 70px 0;
            font-size: 17px;
            line-height: 210%;
        }
        @media (max-width: 599px) {
            body.fullscreen .bar1 div.label {
                font-size: 13px;
            }
        }

        @media (max-width: 479px) {
            body.fullscreen .bar1 div.label {
                font-size: 12px;
            }
        }

        @media (max-width: 359px) {
            body.fullscreen .bar1 div.label {
                font-size: 11px;
            }
        }

    </style>
	
    
	<!-- Здесь начинается айфрейм, выбор карты и кнопки другие.-->
                <iframe data-src-desk="/mario-game/mario.html" data-src-mob="/mario-game/mobilemario.html" loading="lazy" id="game"></iframe>
                <script>
                    var iframe = document.getElementById('game'), src = iframe.getAttribute('data-src-desk');
                    if (window.innerWidth < 991) {
                        src = iframe.getAttribute('data-src-mob');
                        iframe.setAttribute('class', 'mobilegame');
                    }
                    iframe.setAttribute('src', src);
                    <?php if ( !is_user_logged_in() ) { ?>
                    iframe.contentWindow.focus();
                    <?php } ?>
                </script>
                <div id="after" class="padding-15">

                    <div id="out_mapselect" class="bar1">
                        <div class="label"><img src="/mario-game/assets/img/map_icon.png" width="16" alt="выбрать карту"> Map Select</div>
                        <div id="in_mapselect" class="expander"></div>
                    </div>

                    <div id="out_editor" class="bar1" style="display: none;">
                        <div class="label">- Level Editor -</div>
                        <div id="in_editor" class="expander"></div>
                    </div>

                    <div id="out_options" class="bar1" style="display: none;">
                        <div class="label">- Options -</div>
                        <div id="in_options" class="expander"></div>
                    </div>
                    
                       <div id="out_mapselect" class="bar1">
                        <div class="label"><a href="/mario-game/fullscreen.html"><img src="/mario-game/assets/img/fullscreen.png" width="16" alt="полный экран"> Full Screen</a></div>
                       
                    </div>

                    <div id="sound-toggle" class="bar1">
                        <div class="label"><img src="/mario-game/assets/img/sound_on_icon.png" width="16" alt="звук включен"> Sound On</div>
                    </div>

                    <div id="on-button" style="display: none"><img src="/mario-game/assets/img/sound_on_icon.png" width="16" alt="звук включен"> Sound On</div>
                    <div id="off-button" style="display: none"><img src="/mario-game/assets/img/sound_off_icon.png" width="16" alt="звук выключен"> Sound Off</div>

                    <div id="out_keymapping" class="bar1" style="display: none;">
                        <div class="label">- Keys Mapping -</div>
                        <div id="in_keymapping" class="expander"></div>
                    </div>

                </div>
				
	<!-- Важно подключить js файл после подключения айфрейма и кнопок  -->
   
    <script src="/mario-game/ui.js"></script>
        <script type="text/javascript">
                var iframe = document.getElementById('game');
                <?php if ( !is_user_logged_in() ) { ?>
                iframe.contentWindow.focus();
                <?php } ?>
        </script>
	  </div>
	  
<section class="table-section">
			<div class="my-container">
				<div class="table__top">
					<div class="table__attention">Марио обновляет данные в таблице каждый час. В нее могут попасть только 100 лучших игроков.</div>
					<a href="#" class="table__btn">Как попасть в рейтинговую таблицу</a>
				</div>
				<div class="table__container">
					<div class="table__border">
						<table class="table">
							<thead>
								<tr>
									<td class="table__place table__place_head">
										#
										<div class="table__sort">
											<a href="#" class="table__sort-arrow table__sort-arrow_up table__sort-arrow_active">
												<svg width="8" height="5" viewBox="0 0 8 5" xmlns="http://www.w3.org/2000/svg">
													<path d="M4.40962 0.585167C4.21057 0.300808 3.78943 0.300807 3.59038 0.585166L1.05071 4.21327C0.81874 4.54466 1.05582 5 1.46033 5H6.53967C6.94418 5 7.18126 4.54466 6.94929 4.21327L4.40962 0.585167Z"/>
												</svg>
											</a>
											<a href="#" class="table__sort-arrow table__sort-arrow_down">
												<svg width="8" height="5" viewBox="0 0 8 5" xmlns="http://www.w3.org/2000/svg">
													<path d="M4.40962 4.41483C4.21057 4.69919 3.78943 4.69919 3.59038 4.41483L1.05071 0.786732C0.81874 0.455343 1.05582 0 1.46033 0H6.53967C6.94418 0 7.18126 0.455342 6.94929 0.786731L4.40962 4.41483Z"/>
												</svg>
											</a>
										</div>
									</td>
									<td class="table__search table__search_head">
										<div class="table__search-wrapper">
											<button type="submit" class="table__search-btn">
												<svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
													<path fill-rule="evenodd" clip-rule="evenodd" d="M9.34682 10.2776C8.45754 10.9691 7.34008 11.3809 6.12647 11.3809C3.22616 11.3809 0.875 9.02905 0.875 6.12793C0.875 3.22682 3.22616 0.875 6.12647 0.875C9.02677 0.875 11.3779 3.22682 11.3779 6.12793C11.3779 7.34177 10.9663 8.45945 10.2751 9.34893L12.9325 12.0038C13.189 12.2601 13.1892 12.6758 12.933 12.9324C12.6768 13.189 12.2612 13.1892 12.0047 12.933L9.34682 10.2776ZM10.0651 6.12793C10.0651 8.30377 8.30169 10.0676 6.12647 10.0676C3.95124 10.0676 2.18787 8.30377 2.18787 6.12793C2.18787 3.9521 3.95124 2.18823 6.12647 2.18823C8.30169 2.18823 10.0651 3.9521 10.0651 6.12793Z" />
												</svg>
											</button>
											<input type="text" class="table__search-input" name="user" placeholder="Поиск игрока...">
										</div>
									</td>
									<td class="table__country table__country_head">Страна</td>
									<td class="table__points table__points_head">
										Очки
										<div class="table__sort">
											<a href="#" class="table__sort-arrow table__sort-arrow_up table__sort-arrow_active">
												<svg width="8" height="5" viewBox="0 0 8 5" xmlns="http://www.w3.org/2000/svg">
													<path d="M4.40962 0.585167C4.21057 0.300808 3.78943 0.300807 3.59038 0.585166L1.05071 4.21327C0.81874 4.54466 1.05582 5 1.46033 5H6.53967C6.94418 5 7.18126 4.54466 6.94929 4.21327L4.40962 0.585167Z"/>
												</svg>
											</a>
											<a href="#" class="table__sort-arrow table__sort-arrow_down">
												<svg width="8" height="5" viewBox="0 0 8 5" xmlns="http://www.w3.org/2000/svg">
													<path d="M4.40962 4.41483C4.21057 4.69919 3.78943 4.69919 3.59038 4.41483L1.05071 0.786732C0.81874 0.455343 1.05582 0 1.46033 0H6.53967C6.94418 0 7.18126 0.455342 6.94929 0.786731L4.40962 4.41483Z"/>
												</svg>
											</a>
										</div>
									</td>
									<td class="table__progress table__progress_head">Прогресс</td>
									<td class="table__comments table__comments_head">Комментарии</td>
									<td class="table__lastgame table__lastgame_head">
										Последняя игра
										<div class="table__sort">
											<a href="#" class="table__sort-arrow table__sort-arrow_up table__sort-arrow_active">
												<svg width="8" height="5" viewBox="0 0 8 5" xmlns="http://www.w3.org/2000/svg">
													<path d="M4.40962 0.585167C4.21057 0.300808 3.78943 0.300807 3.59038 0.585166L1.05071 4.21327C0.81874 4.54466 1.05582 5 1.46033 5H6.53967C6.94418 5 7.18126 4.54466 6.94929 4.21327L4.40962 0.585167Z"/>
												</svg>
											</a>
											<a href="#" class="table__sort-arrow table__sort-arrow_down">
												<svg width="8" height="5" viewBox="0 0 8 5" xmlns="http://www.w3.org/2000/svg">
													<path d="M4.40962 4.41483C4.21057 4.69919 3.78943 4.69919 3.59038 4.41483L1.05071 0.786732C0.81874 0.455343 1.05582 0 1.46033 0H6.53967C6.94418 0 7.18126 0.455342 6.94929 0.786731L4.40962 4.41483Z"/>
												</svg>
											</a>
										</div>
									</td>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="table__place">1</td>
									<td class="table__user">
										<div class="table__user-wrapper">
											<div class="table__user-image"><a href="#"><img src="/wp-content/themes/supermario/img/user.jpg" alt="Username"></a></div>
											<div class="table__user-info">
												<div class="table__user-name">Username</div>
												<div class="table__user-id"><a href="#">@username</a></div>
											</div>
										</div>
									</td>
									<td class="table__country">
										<img src="/wp-content/themes/supermario/img/flags/ru.svg" alt="Russia">
									</td>
									<td class="table__points">583 050</td>
									<td class="table__progress">
										<div class="table__progress-wrapper">
											<div class="table__progress-line" style="width: 70%;"></div>
										</div>
									</td>
									<td class="table__comments"><a href="#">133</a></td>
									<td class="table__lastgame">10.02.2022</td>
								</tr>
								<tr>
									<td class="table__place">2</td>
									<td class="table__user">
										<div class="table__user-wrapper">
											<div class="table__user-image"><a href="#"><img src="/wp-content/themes/supermario/img/user.jpg" alt="Username"></a></div>
											<div class="table__user-info">
												<div class="table__user-name">Username</div>
												<div class="table__user-id"><a href="#">@username</a></div>
											</div>
										</div>
									</td>
									<td class="table__country">
										<img src="/wp-content/themes/supermario/img/flags/kz.svg" alt="Kazahstan">
									</td>
									<td class="table__points">455 990</td>
									<td class="table__progress">
										<div class="table__progress-wrapper">
											<div class="table__progress-line" style="width: 70%;"></div>
										</div>
									</td>
									<td class="table__comments"><a href="#">13</a></td>
									<td class="table__lastgame">10.02.2022</td>
								</tr>
								<tr>
									<td class="table__place">3</td>
									<td class="table__user">
										<div class="table__user-wrapper">
											<div class="table__user-image"><a href="#"><img src="/wp-content/themes/supermario/img/user.jpg" alt="Username"></a></div>
											<div class="table__user-info">
												<div class="table__user-name">Username</div>
												<div class="table__user-id"><a href="#">@username</a></div>
											</div>
										</div>
									</td>
									<td class="table__country">
										<img src="/wp-content/themes/supermario/img/flags/kz.svg" alt="Kazahstan">
									</td>
									<td class="table__points">390 998</td>
									<td class="table__progress">
										<div class="table__progress-wrapper">
											<div class="table__progress-line" style="width: 70%;"></div>
										</div>
									</td>
									<td class="table__comments"><a href="#">1</a></td>
									<td class="table__lastgame">10.02.2022</td>
								</tr>
								<tr>
									<td class="table__place">4</td>
									<td class="table__user">
										<div class="table__user-wrapper">
											<div class="table__user-image"><a href="#"><img src="/wp-content/themes/supermario/img/user.jpg" alt="Username"></a></div>
											<div class="table__user-info">
												<div class="table__user-name">Username</div>
												<div class="table__user-id"><a href="#">@username</a></div>
											</div>
										</div>
									</td>
									<td class="table__country">
										<img src="/wp-content/themes/supermario/img/flags/ru.svg" alt="Russia">
									</td>
									<td class="table__points">349 776</td>
									<td class="table__progress">
										<div class="table__progress-wrapper">
											<div class="table__progress-line" style="width: 70%;"></div>
										</div>
									</td>
									<td class="table__comments"><a href="#">0</a></td>
									<td class="table__lastgame">10.02.2022</td>
								</tr>
								<tr>
									<td class="table__place">5</td>
									<td class="table__user">
										<div class="table__user-wrapper">
											<div class="table__user-image"><a href="#"><img src="/wp-content/themes/supermario/img/user.jpg" alt="Username"></a></div>
											<div class="table__user-info">
												<div class="table__user-name">Username</div>
												<div class="table__user-id"><a href="#">@username</a></div>
											</div>
										</div>
									</td>
									<td class="table__country">
										<img src="/wp-content/themes/supermario/img/flags/ru.svg" alt="Russia">
									</td>
									<td class="table__points">300 177</td>
									<td class="table__progress">
										<div class="table__progress-wrapper">
											<div class="table__progress-line" style="width: 70%;"></div>
										</div>
									</td>
									<td class="table__comments"><a href="#">133</a></td>
									<td class="table__lastgame">10.02.2022</td>
								</tr>
								<tr>
									<td class="table__place">6</td>
									<td class="table__user">
										<div class="table__user-wrapper">
											<div class="table__user-image"><a href="#"><img src="/wp-content/themes/supermario/img/user.jpg" alt="Username"></a></div>
											<div class="table__user-info">
												<div class="table__user-name">Username</div>
												<div class="table__user-id"><a href="#">@username</a></div>
											</div>
										</div>
									</td>
									<td class="table__country">
										<img src="/wp-content/themes/supermario/img/flags/ru.svg" alt="Russia">
									</td>
									<td class="table__points">300 177</td>
									<td class="table__progress">
										<div class="table__progress-wrapper">
											<div class="table__progress-line" style="width: 70%;"></div>
										</div>
									</td>
									<td class="table__comments"><a href="#">133</a></td>
									<td class="table__lastgame">10.02.2022</td>
								</tr>
								<tr>
									<td class="table__place">7</td>
									<td class="table__user">
										<div class="table__user-wrapper">
											<div class="table__user-image"><a href="#"><img src="/wp-content/themes/supermario/img/user.jpg" alt="Username"></a></div>
											<div class="table__user-info">
												<div class="table__user-name">Username</div>
												<div class="table__user-id"><a href="#">@username</a></div>
											</div>
										</div>
									</td>
									<td class="table__country">
										<img src="/wp-content/themes/supermario/img/flags/ru.svg" alt="Russia">
									</td>
									<td class="table__points">300 177</td>
									<td class="table__progress">
										<div class="table__progress-wrapper">
											<div class="table__progress-line" style="width: 70%;"></div>
										</div>
									</td>
									<td class="table__comments"><a href="#">133</a></td>
									<td class="table__lastgame">10.02.2022</td>
								</tr>
								<tr>
									<td class="table__place">8</td>
									<td class="table__user">
										<div class="table__user-wrapper">
											<div class="table__user-image"><a href="#"><img src="/wp-content/themes/supermario/img/user.jpg" alt="Username"></a></div>
											<div class="table__user-info">
												<div class="table__user-name">Username</div>
												<div class="table__user-id"><a href="#">@username</a></div>
											</div>
										</div>
									</td>
									<td class="table__country">
										<img src="/wp-content/themes/supermario/img/flags/ru.svg" alt="Russia">
									</td>
									<td class="table__points">300 177</td>
									<td class="table__progress">
										<div class="table__progress-wrapper">
											<div class="table__progress-line" style="width: 70%;"></div>
										</div>
									</td>
									<td class="table__comments"><a href="#">133</a></td>
									<td class="table__lastgame">10.02.2022</td>
								</tr>
								<tr>
									<td class="table__place">9</td>
									<td class="table__user">
										<div class="table__user-wrapper">
											<div class="table__user-image"><a href="#"><img src="/wp-content/themes/supermario/img/user.jpg" alt="Username"></a></div>
											<div class="table__user-info">
												<div class="table__user-name">Username</div>
												<div class="table__user-id"><a href="#">@username</a></div>
											</div>
										</div>
									</td>
									<td class="table__country">
										<img src="/wp-content/themes/supermario/img/flags/ru.svg" alt="Russia">
									</td>
									<td class="table__points">300 177</td>
									<td class="table__progress">
										<div class="table__progress-wrapper">
											<div class="table__progress-line" style="width: 70%;"></div>
										</div>
									</td>
									<td class="table__comments"><a href="#">133</a></td>
									<td class="table__lastgame">10.02.2022</td>
								</tr>
								<tr>
									<td class="table__place">10</td>
									<td class="table__user">
										<div class="table__user-wrapper">
											<div class="table__user-image"><a href="#"><img src="/wp-content/themes/supermario/img/user.jpg" alt="Username"></a></div>
											<div class="table__user-info">
												<div class="table__user-name">Username</div>
												<div class="table__user-id"><a href="#">@username</a></div>
											</div>
										</div>
									</td>
									<td class="table__country">
										<img src="/wp-content/themes/supermario/img/flags/ru.svg" alt="Russia">
									</td>
									<td class="table__points">300 177</td>
									<td class="table__progress">
										<div class="table__progress-wrapper">
											<div class="table__progress-line" style="width: 70%;"></div>
										</div>
									</td>
									<td class="table__comments"><a href="#">133</a></td>
									<td class="table__lastgame">10.02.2022</td>
								</tr>
							</tbody>
						</table>
						<div class="table__footer">
							<div class="table__footer-total">1-10 из 100</div>
							<div class="table__count">
								<span>Показывать по:</span>
								<div href="#" class="table__count-wrapper">
									<a href="#" class="table__count-link">10</a>
									<div class="table__count-list">
										<ul>
											<li><a href="#">5</a></li>
											<li class="active"><a href="#">10</a></li>
											<li><a href="#">20</a></li>
											<li><a href="#">30</a></li>
											<li><a href="#">40</a></li>
											<li><a href="#">50</a></li>
											<li><a href="#">100</a></li>
										</ul>
									</div>
								</div>
							</div>
							<div class="table__pagination">
								<a href="#" class="table__pagination-arrow table__pagination-arrow_prev table__pagination-arrow_disabled">
									<svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
										<path d="M9.5 11L6.5 8L9.5 5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
									</svg>
								</a>
								<div class="table__pagination-count">
									<span>1</span>/10
								</div>
								<a href="#" class="table__pagination-arrow table__pagination-arrow_next">
									<svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
										<path d="M6.5 11L9.5 8L6.5 5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
									</svg>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	<link rel="stylesheet" href="/wp-content/themes/supermario/css/table.min.css">
	<script src="/wp-content/themes/supermario/js/table.min.js"></script>
			<div class="main-wrapper">
            	<?php
            	the_content();
            	?>
            	<h2>Полное прохождение Super Mario Bros</h2>
            	<p>Полное прохождение уровней в игре Супер Марио 1985-1990 годов на Денди 8 бит со всеми секретами и пасхалками (тайниками), которые существуют в игре. Ваше путешествие с Марио и его братом Луиджи будет устрашающим и опасным, и выжить нет практически никакого шанса, но сделать это и победить все же возможно!</p>
            	<div class="thumb-wrap">
                  <iframe width="560" height="315" src="https://www.youtube.com/embed/uOIRUi-z1Z4" frameborder="0" allowfullscreen></iframe>
                </div>
            	<?php comments_template(); ?> 
            	
            	<center><script src="https://yastatic.net/share2/share.js"></script> <div class="ya-share2" data-curtain data-shape="round" data-limit="5" data-services="vkontakte,odnoklassniki,telegram,viber,whatsapp"></div></center>
			</div><!-- .main-wrapper -->
		</main><!-- .main -->
	</div><!-- .content-wrapper-->

<?php

get_footer();
