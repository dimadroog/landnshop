<?php 
$params = array(
    'condition'=>'publish=1',
    'order'=>'date DESC',
    // 'limit' => 5,
	);
$articles = Article::model()->findAll($params); 
?>

<?php echo $item->content; ?>
<?php foreach ($articles as $key => $item): ?>
    <div class="panel panel-default <?php echo ($key%2) ? 'wow slideInRight' : 'wow slideInLeft'; ?>" data-wow-delay=".1s">
        <div class="panel-body">
            
            <div class="article-content">
                <h3><?php echo $item->title; ?></h3>
                <p><?php echo $item->content; ?></p>
            </div>
        </div>
    </div>
<?php endforeach ?>    

<?php if (!$articles): ?>
    <h3 class="text-muted">Пока нет статей</h3>
<?php endif; ?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Control Panel - control.mirohost.net</title>

    <link rel="stylesheet" href="/tpls/default/index.css" type="text/css">
    <link rel="stylesheet" href="/tpls/jqueryui/css/jquery.ui.core.css">
    <link rel="stylesheet" href="/tpls/jqueryui/css/jquery.ui.theme.css">
    <link rel="stylesheet" href="/tpls/jqueryui/css/jquery.ui.datepicker.css">

    <script type="text/javascript">
        <!--
        function valid_select () {
            e = document.all("form[target]").value;
            if (e != "frame"){
                document.all("form[target]").focus();
            }
        }

        function showHelp(section, item, p) {
            var u = 'd';
            if (section.length > 0) {
                u = u + '_' + section;
                if (item.length > 0) {
                    u = u + '_' + item;
                }
            }
            window.open(
                "/help/index.php?showhelp=" + u + (p ? "&p=" + p + '#' + p : ''),
                'help',
                'toolbar=no,menubar=no,scrollbars=1,width=600,height=600,resizable=yes,left=200,top=100'
            );
        }
        // -->
    </script>
    <script type="text/javascript" src="/tpls/gen_password.js"></script>
    <script type="text/javascript" src="/tpls/gen_login.js"></script>
    <script type="text/javascript" src="/tpls/tips.js"></script>
    <script type="text/javascript" src="/tpls/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="/tpls/jqueryui/js/jquery.ui.core.js"></script>
    <script type="text/javascript" src="/tpls/jqueryui/js/jquery.ui.datepicker.js"></script>
    <script type="text/javascript" src="/tpls/jqueryui/js/jquery.ui.datepicker-ru.js"></script>
    <script type="text/javascript" src="/dist/jquery-file-download/jquery.fileDownload.js"></script>
    <script type="text/javascript" src="/tpls/jquery.placeholder.js"></script>
    <script type="text/javascript" src="/tpls/popup.js"></script>
    <script type="text/javascript">
        jQuery.noConflict();
    </script>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table id="topline" cellspacing="0" cellpadding="2">
    <tr>
        <td align="left"><span class="vhc">MIROHOST Control Panel v3.1</span></td>
        <td align="right"><span class="vhc">VIRTUAL HOSTING SOLUTIONS</span></td>
    </tr>
</table>

<table id="logoline" cellspacing="0" cellpadding="0">
    <tr>
        <td>
            <a href="javascript:window.location.href='https://mirohost.net/'" target="_blank">
                <img src="/img/logo1.gif" width="200" height="50" border="0" alt="MiroHost.net">
            </a>
        </td>
    </tr>
</table>

<table id="mainblock" cellspacing="0" cellpadding="0" align="center">
    <tr>
        <td width="15%" align="center" class="nav2" style="padding: 0.5em">
                            ПАНЕЛЬ&nbsp;УПРАВЛЕНИЯ АДМИНИСТРАТОРА
                        <br><br>
            Ваш логин
        