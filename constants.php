<?php

//database informatiom
define("SERVER_NAME", "localhost");
define("SERVER_USERNAME", "root");
define("SERVER_PASSWORD", "");
define("DB_NAME", "epiz_28591561_gehnaglow");

//general information
define("CUR_DIR", "http://" . $_SERVER['SERVER_NAME'] . "/gehnaglow/");
define("SITE_NAME", "GehnaGlow");
define('MOBILE', '9999999999');
define('MOBILE_HREF', 'tel:91' . MOBILE);
define('EMAIL', 'gehnaglow@gmail.com');
define('EMAIL_HREF', 'mailto:' . EMAIL);
define('ADDRESS', 'Nangloi');
define('ADDRESS_HREF', 'https://goo.gl/maps/ofdbm1Q9HfQAFG5D6');
define('GOOGLE_MAP', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14008.213914757775!2d77.28298212390501!3d28.628159253229047!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce4adab49c4c7%3A0x8ae44ef6f12ad565!2sMandawali%2C%20New%20Delhi%2C%20Delhi%20110092!5e0!3m2!1sen!2sin!4v1632501270848!5m2!1sen!2sin');

//social media links
define('FACEBOOK', 'https://facebook.com/');
define('INSTAGRAM', 'https://instagram.com/');
define('YOUTUBE', 'https://youtube.com/');

//date and time information
date_default_timezone_set("Asia/Kolkata");
define("DATE_TODAY", date("Y-m-d"));
define("ROWS_PER_PAGE", "10");
