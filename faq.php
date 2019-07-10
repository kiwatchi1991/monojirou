<?php 
//共通変数・関数ファイルを読込み
require('function.php');
?>

<!--ヘッダータグ-->
<?php 
$siteTitle ='HOME';
require('head.php');
?>

<body class="page-toppage page-1colum">



<!--  ヘッダー -->
<?php 
require('header.php');
?>

<div class="msg">
  <p id="js-show-msg" style="display:none;" class="msg-slide">
    <?php echo getSessionFlash('msg_success'); ?>
  </p>
</div>

<!--  広告タブ-->
<?php 
require('ads.php');
?>

<!--メニュータブ-->
<?php 
require('menuTab.php');
?>


  <!-- メインコンテンツ -->
  <div id="contents" class="site-width">
  <p style="text-align:center;">申し訳ございません。  ただいま準備中です。</p>
  </div>

    <!-- footer -->
    <?php
    require('footer.php'); 
    ?>
    <script>

    </script>


    </body>
  </html>