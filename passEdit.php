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
    
//    古いパスワードとDBパスワードを称号（DBに入っているデータと同じであれば、半角英数字チェックや最大文字数チェックは行わなくても問題ない）
    if(!password_verify($pass_old, $userData['password'])){
      $err_msg['pass_old'] = MSG12;
    }
    
//    新しいパスワードと古いパスワードが同じかチェック
    if($pass_old === $pass_new){
      $err_msg['pass_new'] = MSG13;
      
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
            
          }
          
        }
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

<body class="page-passEdit page-1colum">


  <!--  ヘッダー-->
  <?php 
  require('header.php');
  ?>

  <!--メニュータブ-->
  <?php 
  require('menuTab.php');
  ?>

  <div class="site-width">

    <p style="text-align:center; margin-top:50px;" >パスワード編集ページです</p>
    <p style="text-align:center;" >パスワード編集ページです</p>
    <p style="text-align:center;" >パスワード編集ページです</p>
    <p style="text-align:center;" >パスワード編集ページです</p>
    <p style="text-align:center;" >パスワード編集ページです</p>
    <p style="text-align:center;" >パスワード編集ページです</p>
    <p style="text-align:center;" >パスワード編集ページです</p>
    <p style="text-align:center;" >パスワード編集ページです</p>
    <p style="text-align:center;" >パスワード編集ページです</p>
     
     
   
 

  </div>







  <!-- footer -->
  <?php
  require('footer.php'); 
  ?>



</body>
</html>
