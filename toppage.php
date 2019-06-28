<?php 
//共通変数・関数ファイルを読込み
require('function.php');

debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debug('「　トップページ　」');
debug('」」」」」」」」」」」」」」」」」」」」」」」」」」」」」」」」');
debugLogStart();

//================================
// 画面処理
//================================

// 画面表示用データ取得
//================================
// GETパラメータを取得
//----------------------------------
// カレントページ

$currentPageNum = (!empty($_GET['p'])) ? $_GET['p'] : 1; //デフォルトは１ページ目
//カテゴリー
$category = (!empty($_GET['sort'])) ? $_GET['c_id'] : '';
//ソート順
$sort = (!empty($_GET['sort'])) ? $_GET['sort'] : '';
//パラメータに不正な値が入っているかチェック
if(!is_int($currentPageNum)){
  error_log('エラー発生:指定ページに不正な値が入りました。')
  header("Location:toppage.php");//トップページへ
}
//表示件数
$listSpan = 20;
//現在の表示レコード先頭を算出
$currentMinNum = (($currentPageNum-1)*$listSpan); //1ページ目なら（１−１）*20 = 0、２ページ目なら（２−１）＊２０　＝　２０
//DBから商品データを取得
$dbCategoryData = getCategory();
//debug('DBデータ：'.print_r($dbFormData,true));
//debug('カテゴリデータ：'.print_r($dbCategoryData,true));

debug('画面表示処理終了 <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<');
?>
<!--ヘッダータグ-->
<?php 
$siteTitle ='HOME';
require('head.php');
?>

  <body class="page-toppage page-2colum">


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

    <p>トップページです</p>
    <p>トップページです</p>
    <p>トップページです</p>
    <p>トップページです</p>


  </div>







  <!-- footer -->
  <?php
  require('footer.php'); 
  ?>
  <script>

  </script>


</body>
</html>
