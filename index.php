<!doctype html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link type="text/css" rel="stylesheet" href="css/main.css" />
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/jquery.timer.js"></script>
        <script type="text/javascript" src="js/main.js"></script>
    </head>

    <body>
        <div id="left"></div>
        <div id="right"></div>
        <div id="top"></div>
        <div id="bottom"></div>

        <div id="light"></div>

        <div id="text">
            <div id="text-content"></div>
        </div>

        <div id="overlay">
            <input type="text" />
        </div>

        <div id="yep"></div>
        <div id="nope"></div>

        <div id="timer"></div>

        <div id="end">
            <div id="endtext">
                Gratuliere! Du hast den ganzen Quatsch hier in sage und schreibe <span></span> geschafft! Ich bin stolz auf dich!<br /><br /> Zu dumm, dass die Punktzahl dir nicht im Geringsten weiter hilft.<br /><br />
                Aber du hast dir ja ganz bestimmt gemerkt, welche elf Begriffe du eben erraten hast, oder? Nein? Schade, denn deren Anfangsbuchstaben aneinander gereiht ergeben nämlich dein Geburtstagsgeschenk!<br /><br />
                Also: Nochmal ganz angestrengt überlegen, sonst behalte ich's! :D
            </div>

            <div id="endsolution">
            <?php for ($i = 0; $i < 11; $i++) { ?>
                <input type="text" class="letter" maxlength="1" />
            <?php } ?>
            </div>
        </div>
    </body>
</html>
