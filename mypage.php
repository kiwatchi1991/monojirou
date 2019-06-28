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

<body class="page-mypage page-1colum">


  <!--  ヘッダー-->
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

  <div class="site-width">
    
    <p>マイページです</p>
    <p>マイページです</p>
    <p>マイページです</p>
    <p>マイページです</p>
    <p>マイページです</p>
    <p>マイページです</p>
    <p>マイページです</p>
    <p>マイページです</p>
    <p>マイページです</p>

    <p>マイページです</p>
    <p>マイページです</p>
    <p>マイページです</p>
    <p>マイページです</p>
    <p>マイページです</p>
    <p>マイページです</p>
    <p>マイページです</p>

    <p>マイページです</p>
    <p>マイページです</p>
    <p>マイページです</p>
    <p>マイページです</p>
    <p>マイページです</p>
    <p>マイページです</p>
    <p>マイページです</p>

    <p>マイページです</p>
    <p>マイページです</p>
    <p>マイページです</p>
    <p>マイページです</p>
    <p>マイページです</p>
    <p>マイページです</p>
    <p>マイページです</p>
      
      
    </div>
    






  <!-- footer -->
  <?php
  require('footer.php'); 
  ?>
<script>
  
</script>


</body>
</html>
