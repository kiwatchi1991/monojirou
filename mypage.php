<?php 
//共通変数・関数ファイルを読込み
require('function.php');

debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debug('「　マイページ　」');
debug('」」」」」」」」」」」」」」」」」」」」」」」」」」」」」」」」');
debugLogStart();

?>


<!--ヘッダータグ-->
<?php 
$siteTitle ='マイページ';
require('head.php');
?>

<body class="page-signup page-1colum">
マイページです

  <!--  ヘッダー-->
  <?php 
  require('header.php');
  ?>

  <p id="js-show-msg" style="display:none;" class="msg-slide">
    <?php echo getSessionFlash('msg_success'); ?>
  </p>






  <!-- footer -->
  <?php
  require('footer.php'); 
  ?>



</body>
</html>
