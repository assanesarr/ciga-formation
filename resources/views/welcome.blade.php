<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>

        <link rel="stylesheet" href="{{ asset('maintenance/style.css') }}" type="text/css" media="screen">

        <script type="text/javascript" src="{{ asset('maintenance/js/jquery-1.7.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('maintenance/js/jquery.countdown.js') }}"></script>
        <script type="text/javascript" src="{{ asset('maintenance/js/jquery.tipsy.js') }}"></script>
        <script type="text/javascript" src="{{ asset('maintenance/js/jquery.subscribe.js') }}"></script>
        <script type="text/javascript" src="{{ asset('maintenance/js/jquery.contact.js') }}"></script>
        <script type="text/javascript" src="{{ asset('maintenance/js/custom.js') }}"></script>
    </head>
    <body>
    <div id="wrapper">
        <header>
            <a class="logo" href="#">Votre Intégrateur Réseau System et Sécurité</a>
        </header>

        <div id="book">

            <div id="ribbon" class="contact">click me to reveal the contact form</div>
            <div class="top-page"></div>

            <div class="content-page">
                <div class="top-spiral"></div>
                <div class="bottom-spiral"></div>

                <div id="cform">
                    <div class="row"></div>
                    <h3>Get in touch with us:</h3>
                    <div class="form-wrapper in-touch">
                        <div id="message"></div>
                        <form method="post" action="#" name="contactform" id="contactform">
                            <input type="text" name="name" placeholder="Name" id="name" />
                            <input type="text" name="email" placeholder="Email" id="email" />
                            <input type="text" name="phone" placeholder="Phone" id="phone" />
                            <input type="text" name="subject" placeholder="Subject" id="subject" />
                            <textarea placeholder="Message" name="comments" id="comments"></textarea>
                            <div id="captcha">
                                <span>3+1=</span>
                                <input type="text" name="verify" id="verify" />
                            </div><!--end verify-->

                            <!-- You can stylize the submit button by changing its color. To do this, replace the 'orange' from class="orange" with: yellow, red, purple, green, blue, darkblue, white and black.-->
                            <input type="submit" name="send" value="SEND" id="submit" class="orange" />
                        </form>
                    </div><!--end form-wrapper-->
                </div><!--end cform-->

                <div id="home">
                    <div class="row"></div>
                    <h2>Nous sommes actuellement en Maintenance!</h2>
                    <div class="row"></div>
                    <div class="row"></div>
                    <h3>Nous travaillons dur et pensons que nous allons lancer le site Web en:</h3>

                    <div id="countdown"></div>
                    <div class="clear"></div>
                    <div class="row"></div>
                    <div class="form-wrapper email-list">
                        <div id="mesaj"></div>
                        <form id="subscribe" method="post" action="#" name="subscribe">
                            <input type="text" id="semail" name="YourEmail" placeholder="Subscribe to our email list" />

                            <!-- You can stylize the submit button by changing its color. To do this, replace the 'orange' from class="orange" with: yellow, red, purple, green, blue, darkblue, white and black.-->
                            <input type="submit" id="ssubmit" name="subscribe" value="SUBSCRIBE" class="orange" />
                        </form>
                    </div><!--end form-wrapper-->
                </div><!--end home-->

            </div><!--end content-page-->

            <div class="bottom-page">
                <ul class="social">
                    <!-- Change the # with the link to your social page. -->
                    <li><a class="facebook tooltip" href="#" title="Facebook"></a></li>
                    <li><a class="twitter tooltip" href="#" title="Twitter"></a></li>
                    <li><a class="youtube tooltip" href="#" title="YouTube"></a></li>
                    <li><a class="skype tooltip" href="#" title="Skype"></a></li>
                    <li><a class="dribbble tooltip" href="#" title="Dribbble"></a></li>

                    <!-- You can add to social list buttons for digg, delicious, vimeo and dropbox. Just delete the brackets from below -->
                    <!--	<li><a class="digg tooltip" href="#" title="Digg"></a></li>
                            <li><a class="delicious tooltip" href="#" title="Delicious"></a></li>
                            <li><a class="vimeo tooltip" href="#" title="Vimeo"></a></li>
                            <li><a class="dropbox tooltip" href="#" title="DropBox"></a></li>
                    -->
                </ul>
            </div><!--end bottom-page-->
        </div><!--end book-->

        <p class="copyright">Copyright &copy; <a href="https://chicorycom.net">Chicorycom</a>  - All Rights Reserved</p>

    </div><!--end wrapper-->
    <script type="text/javascript" src="{{ asset('maintenance/js/jquery.placeholder.js') }}"></script>	<!-- placeholder html5 tag support for IE and Old Browsers -->
    </body>
</html>
