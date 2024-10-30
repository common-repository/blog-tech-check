<?php header("Content-type: text/css"); ?>

.logo {float:left; padding:10px 20px 5px 0;}
.help {vertical-align: middle;}
h2.heading {background-image:url("<? echo $pluginurl; ?>images/logo_cog.png"); background-repeat: no-repeat; background-position: center left; font-size:28px !important; margin: 5px 0 0 0 !important; line-height:120px !important; text-indent: 140px !important;}
.helpmsg {padding:15px 10px 15px 50px !important; background:#f3f3f3; color:#464646; margin-bottom: 0 !important;}
td.pass {padding:15px 10px 15px 50px !important; background:#DFF2BF; background-image:url("<? echo $plugindir; ?>images/pass.png"); background-repeat:no-repeat; background-position:10px center; color:#4F8A10; margin:10px 0px;}
td.fail {padding:15px 10px 15px 50px !important; background:#FFBABA; background-image:url("<? echo $plugindir; ?>images/fail.png"); background-repeat:no-repeat; background-position:10px center; color:#D8000C; margin:10px 0px;}
.summary {float:right;}
.recheck {float:left;}
ol, li {font-size: inherit !important;}
ol.steps, ul.steps {margin-left: 50px !important; padding:10px 0 10px 0;}