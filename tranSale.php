<?php 
//共通変数・関数ファイルを読込み
require('function.php');

debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debug('「　販売履歴ページ　」');
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
//DBから販売履歴データを取得
$saleData = getMySaleHistory($u_id);


//debug('取得したユーザーネームデータ：'.print_r($dealUserName,true));
debug('取得した販売履歴データ：'.print_r($saleData,true));

debug('画面表示処理終了<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<');
?>

<?php 
$siteTitle = '販売履歴';
require('head.php');
?>

    <style>
      .page-tranSale .panel-list{
        overflow: hidden;
        position: relative;
        width: 100%;
      }
      .page-tranSale .panel-list  .panel{
        display: block;
        clear: both;
        height: 300px;
        width: 100%;
        border: 3px solid #333;
        margin-bottom: 5px;
        padding-top: 15px;
        box-sizing: border-box;
        position: relative;
      }
      .page-tranSale .panel-head{
        float: left;
        height: 100%;
/*        position: relative;*/
      }
      .page-tranSale .panel-body{
        float: left;
        width: 600px;
        height: 100%;
        margin-left: 20px;
        box-sizing: border-box;
/*        position: relative;*/
      }
      
      .page-tranSale #main img{
        width: 300px;
        height:  250px;
      }
      
      .panel-title{
        font-size: 20px;
      }
      
      .price{
        font-size: 20px;
        margin-top: 10px;
      }
      
      .panel-comment{
        margin-top: 10px;
      }
      
      .panel-buyuser{
        font-size: 20px;
        position: absolute;
        bottom: 15px;
      }
      
      .panel-list .panel img{
        
      }
    </style>


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
  
    <h1 class="page-title">販売履歴</h1>
  
    <!-- Main -->
    <section id="main" >
     <section class="list panel-list">
       <h2 class="title" style="margin-bottom:15px;">
         販売履歴一覧
       </h2>
       <?php 
          if(!empty($saleData)):
            foreach($saleData as $key => $val):
       ?>
       
      <div class="panel">
       <div class="panel-head">
         <img src="<?php echo showImg(sanitize($val['pic1'])); ?>" alt="<?php echo sanitize($val['name']); ?>">
       </div>
       <div class="panel-body">
         <p class="panel-title">商品名: <?php echo sanitize($val['name']); ?><span class="price">¥<?php echo sanitize(number_format($val['price'])); ?></span></p>
         
         <p class="panel-comment">
           <?php echo sanitize($val['comment'])?>
         </p>
         
          <p class="panel-buyuser">
           購入者: <?php echo sanitize($val['user'][0]['username']); ?>
         </p>
       </div>
      </div>
      
       
       <?php 
       endforeach;
       endif;
       ?>
     </section>
     
     
     
     
     
     
     
      <a href="mypage.html">&lt; マイページに戻る</a>
    </section>
  </div>

  <!-- footer -->
  <?php
  require('footer.php'); 
  ?>
