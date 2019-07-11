<?php 
//共通変数・関数ファイルを読込み
require('function.php');

debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debug('「　連絡掲示板一覧ページ　」');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debugLogStart();

//================================
// 画面処理
//================================
//ログイン認証
require('auth.php');

//画面表示用データ取得
//==================================
$u_id = $_SESSION['user_id'];

//DBから連絡掲示板データを取得
$bordData = getMyMsgsAndBord2($u_id);

debug('取得した掲示板データ：'.print_r($bordData,true));
debug('画面表示処理終了　<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<');
?>

<!--ヘッダータグ-->
<?php 
$siteTitle ='連絡掲示板一覧';
require('head.php');
?>

<body class="page-mypage page-1colum page-logined">

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

    <h1 class="page-title">連絡掲示板一覧</h1>

    <section class="list list-table">

      <table class="table">
        <thead>
          <tr>
            <th>最新送信日時</th>
            <th class="sale-buy" >購入 / 販売</th>
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
            <td width="200px;"><?php echo sanitize(date('Y.m.d H:i:s' ,strtotime($msg['send_date']))); ?></td>

            <td align="center" width="200px;">
              <a href="msg.php?m_id=<?php echo sanitize($val['id']); ?>" class="<?php echo ($val['sale_user'] === $u_id) ? 'sale' : 'buy';?>">
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

            <td align="center"  width="150px;">
              <a href="msg.php?m_id=<?php echo sanitize($val['id']); ?>" class="<?php echo ($val['sale_user'] === $u_id) ? 'sale' : 'buy'; ?>">
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
  </div>

  <!-- footer -->
  <?php
  require('footer.php'); 
  ?>
  
</body>
</html>




