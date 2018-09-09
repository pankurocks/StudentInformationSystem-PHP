<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Student Information System</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
        <script src="js/jquery.min.js"></script>
        <script src="js/skel.min.js"></script>
        <script src="js/skel-layers.min.js"></script>
        <script src="js/init.js"></script>
        <noscript>
        <link rel="stylesheet" href="css/skel.css" />
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="css/style-xlarge.css" />
        </noscript>
    </head>
    <body class="landing">

        <?php require_once 'include/header.inc.php';?>
       

        <?php require_once './include/banner.inc.php';?>

        <!-- One -->
        <section id="one" class="wrapper style1 special">
            <div class="container">
                <header class="major">
                    <h2>Get all the Information about Registered Students</h2>
                    <p>Easy to use Student Information System!</p>
                </header>
                <div class="row 150%">
                    <div class="4u 12u$(medium)">
                        <section class="box">
                            <i class="icon big rounded color1 fa-cloud"></i>
                            <h3>Register Students</h3>
                            <p>Register Students in easy to use one click option.</p>
                        </section>
                    </div>
                    <div class="4u 12u$(medium)">
                        <section class="box">
                            <i class="icon big rounded color9 fa-desktop"></i>
                            <h3>Search Students</h3>
                            <p> Search the details of students from the large database with ease.</p>
                        </section>
                    </div>
                    <div class="4u$ 12u$(medium)">
                        <section class="box">
                            <i class="icon big rounded color6 fa-rocket"></i>
                            <h3>Update/Delete Student Records</h3>
                            <p>Easy Maintainance of Student Records.</p>
                        </section>
                    </div>
                </div>
            </div>
        </section>

       
        <!-- Three -->
        <section id="three" class="wrapper style3 special">
            <div class="container">
                <header class="major">
                    <h2>Any Problems ?</h2>
                    <p>Feel Free to Contact Us!</p>
                </header>
            </div>
            <div class="container 50%">
                <form action="#" method="post">
                    <div class="row uniform">
                        <div class="6u 12u$(small)">
                            <input name="name" id="name" value="" placeholder="Name" type="text">
                        </div>
                        <div class="6u$ 12u$(small)">
                            <input name="email" id="email" value="" placeholder="Email" type="email">
                        </div>
                        <div class="12u$">
                            <textarea name="message" id="message" placeholder="Message" rows="6"></textarea>
                        </div>
                        <div class="12u$">
                            <ul class="actions">
                                <li><input value="Send Message" class="special big" type="submit"></li>
                            </ul>
                        </div>
                    </div>
                </form>
            </div>
        </section>

       <?php require_once './include/footer.inc.php';?>

    </body>
</html>