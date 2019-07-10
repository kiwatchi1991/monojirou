<?php 
//共通変数・関数ファイルを読込み
require('function.php');

debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debug('「　マイページ　」');
debug('」」」」」」」」」」」」」」」」」」」」」」」」」」」」」」」」');
debugLogStart();



//================================
// 画面処理
//================================
//ログイン認証
require('auth.php');

//画面表示用データ取得
//==================================
$u_id = $_SESSION['user_id'];
//DBから商品データを取得
$productData = getMyProducts($u_id);
//DBから連絡掲示板データを取得
$bordData = getMyMsgsAndBord2($u_id);
//$bord = array_shift($bordData);
//DBからお気に入りデータを取得
$likeData = getMyLike($u_id);
////saleユーザー情報取得
//$saleUser = getSaleUser($bordData['sale_user']);
////buyユーザー情報取得
//$buyUser = getBuyUser($bordData['buy_user']);

//DBからきちんとデータがすべて取れているかのチェックは行わず、取れなければ何も表示しないこととする

debug('取得した商品データ：'.print_r($productData,true));
debug('取得した掲示板データ：'.print_r($bordData,true));
debug('取得したお気に入りデータ：'.print_r($likeData,true));

debug('画面表示処理終了　<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<');
?>

<!--ヘッダータグ-->
<?php 
$siteTitle ='マイページ';
require('head.php');
?>

  <body class="page-mypage page-1colum page-logined">
    <style>
      #main{
        border:none !important;
      }
    </style>
  
  <!--  ヘッダー-->
  <?php 
  require('header.php');
  ?>
  
    <p id="js-show-msg" style="display:none;" class="msg-slide">
    <?php echo getSessionFlash('msg_success'); ?>
    </p>

<!--  広告タブ-->
  <?php 
  require('ads.php');
  ?>
  
<!--メニュータブ-->
  <?php 
  require('menuTab.php');
  ?>

<!--メインコンテンツ-->
  <div id="contents" class="site-width">
    
    <h1 class="page-title">MYPAGE</h1>
     
<!--     Main-->
     <section id="main">
       <section class="list panel-list">
        <h2 class="title" style="margin-bottom:15px;">
          登録商品一覧
        </h2>
        <?php 
            if(!empty($productData)):
              foreach($productData as $key => $val):
         ?>
           <a href="registProduct.php<?php echo (!empty(appendGetParam())) ? appendGetParam().'&p_id='.$val['id'] : '?p_id='.$val['id']; ?>" class="panel">
             <div class="panel-head">
               <img src="<?php echo showImg(sanitize($val['pic1'])); ?>" alt="<?php echo sanitize($val['name']); ?>">
             </div>
             <div class="panel-body">
               <p class="panel-title"><?php echo mb_substr(sanitize($val['name']),0,10); ?><?php if((mb_strlen(sanitize($val['name']))) >= 10){
              echo '...'; } ?>
            <span class="price">¥<?php echo sanitize(number_format($val['price'])); ?></span></p>
             </div>
           </a>
           <?php 
              endforeach;
            endif;
            ?>
       </section>
       
       <style>
         .list{
           margin-bottom: 30px;
         }
       </style>
       
       <section class="list list-table">
         <h2 class="title">
           連絡掲示板一覧
         </h2>
         <table class="table">
           <thead>
             <tr>
               <th>最新送信日時</th>
               <th>購入 / 販売</th>
               <th>取引相手</th>
               <th>メッセージ</th>
             </tr>
           </thead>
           <tbody>
             <?php 
              if(!empty($bordData)){
                foreach($bordData as $key => $val){
                  
                  $saleuser = getSaleUserName($val['id']);
                  $buyuser = getBuyUserName($val['id']);
                  debug('●●●●●●●●●●●●●●●●●$saleuserを表示します●●●'.print_r($saleuser,true));
                  debug('●●●●●●●●●●●●●●●●●$buyuserを表示します●●●'.print_r($buyuser,true));
                  
                  if(!empty($val['msg'])){
                    $msg = array_shift($val['msg']);
                    
              ?>
                   <tr>
                     <td width="300px;"><?php echo sanitize(date('Y.m.d H:i:s' ,strtotime($msg['send_date']))); ?></td>
                     
                     <td width="150px;">
                     <a href="msg.php?m_id=<?php echo sanitize($val['id']); ?>">
                      <?php 
                      echo ($val['sale_user'] === $u_id) ? '販売' : '購入';
                       ?></a></td>
                       
                     <td width="150px;">
                     <?php echo
                     ($val['sale_user'] === $u_id) ? $buyuser[0]['username'] : $saleuser[0]['username'] ;
                       ?></td>
                       
                     <td><a href="msg.php?m_id=<?php echo sanitize($val['id']); ?>"><?php echo mb_substr(sanitize($msg['msg']),0,20); ?><?php if((mb_strlen(sanitize($msg['msg']))) >= 20){ echo '...'; } ?></a></td>
                   </tr>
              <?php 
                  }else{
             ?>
                   <tr>
                     <td width="300px;">--</td>
                     
                     <td width="150px;">
                      <a href="msg.php?m_id=<?php echo sanitize($val['id']); ?>">
                       <?php 
                    echo ($val['sale_user'] === $u_id) ? '販売' : '購入';
                        ?></a></td>
                       
                     <td width="150px;"><?php 
                    echo ($val['sale_user'] === $u_id) ? $buyuser[0]['username'] : $saleuser[0]['username'] ;
                       ?></td>
                     
                     <td><a href="msg.php?m_id=<?php echo sanitize($val['id']); ?>">まだメッセージはありません</a></td>
                   </tr>
              <?php 
                  }
                }
              }
             ?>
           </tbody>
         </table>
       </section>
       
       <?php 
//       var_dump($bordData);
//       debug('●●●●●●●●●●●●●●●●●$bordDataを表示します●●●'.print_r($bordData,true));
       ?>
       
       <section class="list panel-list">
         <h2 class="title" style="margin-bottom:15px;">
           お気に入り一覧
         </h2>
         <?php 
            if(!empty($likeData)):
             foreach($likeData as $key => $val):
         ?>
         <a href="productDetail.php<?php echo (!empty(appendGetParam())) ? appendGetParam().'&p_id='.$val['id'] : '?p_id='.$val['id']; ?>" class="panel">
           <div class="panel-head">
             <img src="<?php echo showImg(sanitize($val['pic1'])); ?>" alt="<?php echo sanitize($val['name']); ?>">
           </div>
           <div class="panel-body">
             <p class="panel-title"><?php echo sanitize($val['name']); ?> <span class="price">¥<?php echo sanitize(number_format($val['price'])); ?></span></p>
           </div>
         </a>
         <?php 
            endforeach;
          endif;
         ?>
       </section>
     </section>
      
      
    </div>

  <!-- footer -->
  <?php
  require('footer.php'); 
  ?>
<script>
  
</script>


</body>
</html>
