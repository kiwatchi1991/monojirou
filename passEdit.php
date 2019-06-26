<?php 
//共通変数・関数ファイルを読込み
require('function.php');

debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debug('「　パスワード変更ページ　」');
debug('」」」」」」」」」」」」」」」」」」」」」」」」」」」」」」」」');
debugLogStart();


//ログイン認証
require('auth.php');

//================================
// 画面処理
//================================
// DBからユーザーデータを取得
$userData = getUser($_SESSION['user_id']);
debug('取得したユーザー情報：'.print_r($userData,true));

//post送信されていた場合
if(!empty($_POST)){
  debug('POST送信があります。');
  debug('POST情報：'.print_r($_POST,true));
  
  //変数にユーザー情報を代入
  $pass_old = $_POST['pass_old'];
  $pass_new = $_POST['pass_new'];
  $pass_new_re = $_POST['pass_new_re'];
  
  //未入力チェック
  validRequired($pass_old, 'pass_old');
  validRequired($pass_new, 'pass_new');
  validRequired($pass_new_re, 'pass_new_re');
  
  if(empty($err_msg)){
    debug('未入力チェックOK');
    
//    古いパスワードのチェック
    validPass($pass_old, 'pass_old');
//    新しいパスワードのチェック
    validPass($pass_new, 'pass_new');
    
//==========================================
//確認用デバッグコード
//==========================================
    
    debug(print_r($userData['password'],true));
    
//    古いパスワードとDBパスワードを称号（DBに入っているデータと同じであれば、半角英数字チェックや最大文字数チェックは行わなくても問題ない）
    if(!password_verify($pass_old, $userData['password'])){
      $err_msg['pass_old'] = MSG12;
    }
    
//    新しいパスワードと古いパスワードが同じかチェック
    if($pass_old === $pass_new){
      $err_msg['pass_new'] = MSG13;
    }
//      パスワードとパスワード再入力があっているかチェック（ログイン画面では最大、最小チェックもしていたがパスワードの方でチェックしているので実は必要ない）
      validMatch($pass_new, $pass_new_re, 'pass_new_re');
      
      if(empty($err_msg)){
        debug('バリデーションOK。');
        
//        例外処理
        try {
          //DBへ接続
          $dbh = dbConnect();
//          SQL文作成
          $sql = 'UPDATE users SET password = :pass WHERE id = :id';
          $data = array(':id' => $_SESSION['user_id'], ':pass' => password_hash($pass_new, PASSWORD_DEFAULT));
//          クエリ実行
          $stmt = queryPost($dbh, $sql, $data);
          
//          クエリ成功の場合
          if($stmt){
            $_SESSION['msg_success'] = SUC01;
            
//            メールを送信
            $username = ($userData['username']) ? $userData['username'] : '名無し';
            $from = 'info@webukatu.com';
            $to = $userData['email'];
            $subject = 'パスワード変更通知 | MONOJIROU';
//            EOTはEndOfFileの略。ABCでもなんでもいい。先頭の<<<の後の文字列と合わせること。最後のEOTの前後に空白など何も入れてはいけない。
//              EOT内の半角空白も全てそのまま半角空白として扱われるのインデントはしないこと
            $comment = <<<EOT
{$username}　さん
パスワードが変更されました。

////////////////////////////////////////
ウェブカツマーケットカスタマーセンター
URL  http://webukatu.com/
E-mail info@webukatu.com
////////////////////////////////////////
EOT;
            sendMail($from, $to, $subject, $comment);
            
            header("Location:mypage.php");//マイページへ
          }
          
        } catch (Exception $e) {
          error_log('エラー発生:' . $e->getMessage());
          $err_msg['common'] = MSG07;
        }
      }
    }
  }
?>

<!--ヘッダータグ-->
<?php 
$siteTitle ='パスワード編集ページ';
require('head.php');
?>

<body class="page-passEdit page-1colum page-logined">
  <style>
    .form{
      margin-top: 50px;
    }
  </style>


  <!--  ヘッダー-->
  <?php 
  require('header.php');
  ?>

  <!--メニュータブ-->
  <?php 
  require('menuTab.php');
  ?>

  <!--メインコンテンツ-->
  <div id="contents" class="site-width">
    <h1 class="page-title">パスワード</h1>
<!--   Main-->
    <section id="main">
      <div class="form-container">
        <form action="" method="post" class="form">
          <div class="area-msg">
            <?php 
            echo getErrMsg('common');
            ?>
          </div>
          <label class="<?php if(!empty($err_msg['pass_old'])) echo 'err'; ?>">
            古いパスワード
            <input type="password" name="pass_old" value="<?php echo getFormData('pass_old'); ?>">
          </label>
          <div class="area-msg">
            <?php 
            echo getErrMsg('pass_old');
            ?>
            </div>
            <label class="<?php if(!empty($err_msg['pass_new'])) echo 'err'; ?>">
              新しいパスワード
              <input type="password" name="pass_new" value="<?php echo getFormData('pass_new'); ?>">
            </label>
            <div class="area-msg">
              <?php 
              echo getErrMsg('pass_new');
              ?>
            </div>
            <label class="<?php if(!empty($err_msg['pass_new_re'])) echo 'err'; ?>">
              新しいパスワード（再入力）
              <input type="password" name="pass_new_re" value="<?php echo getFormData('pass_new_re'); ?>">
            </label>
            <div class="area-msg">
              <?php 
              echo getErrMsg('pass_new_re');
              ?>
            </div>
            <div class="btn-container">
              <input type="submit" class="btn btn-mid" value="変更する">
            </div>
        </form>
      </div>
    </section>
 

  </div>


  <!-- footer -->
  <?php
  require('footer.php'); 
  ?>



</body>
</html>
