<?php 
//共通変数・関数ファイルを読込み
require('function.php');

debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debug('「　商品詳細ページ　」');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debugLogStart();

//================================
// 画面処理
//================================
//ログイン認証
require('auth.php');

//画面表示用でーた取得
//=================================
$u_id = $_SESSION['user_id'];
//DBから商品データを取得



debug('画面表示処理終了<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<');
?>

<?php 
$siteTitle = '販売履歴';
require('head.php');
?>

<body class="page-tranSale page-1colum page-logined">

  <!--   メニュー-->
  <?php 
  require('header.php');
  ?>

  <!--  広告タブ-->
  <?php 
  require('ads.php');
  ?>

  <!--メニュータブ-->
  <?php 
  require('menuTab.php');
  ?>

  <!--    メインコンテンツ-->
  <div id="contents" class="site-width">
  
    <!-- Main -->
    <section id="main" >
      <h1 class="page-title">販売履歴</h1>
      <a href="mypage.html">&lt; マイページに戻る</a>
    </section>
  </div>

  <!-- footer -->
  <?php
  require('footer.php'); 
  ?>
