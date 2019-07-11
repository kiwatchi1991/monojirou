<?php 
//共通変数・関数ファイルを読込み
require('function.php');

debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debug('「　お問い合わせページ　」');
debug('」」」」」」」」」」」」」」」」」」」」」」」」」」」」」」」」');
debugLogStart();



//post送信されていた場合
if(!empty($_POST)){
  debug('POST送信があります。');
  debug('POST情報:'.print_r($_POST,true));
  
//変数にユーザー情報を代入
  $name = (!empty($_POST['name'])) ? $_POST['name'] : null;
  $email = (!empty($_POST['email'])) ? $_POST['email'] : null;
  $subject ="";
  $message = (!empty($_POST['message'])) ? $_POST['message'] : null;
  
  //バリデーション
  validRequired($name, 'name');
  validRequired($email, 'email');
  validRequired($message, 'message');
  
  //emailの形式チェック
  validEmail($email, 'email');
  
  debug('エラーメッセージの有無'.print_r($err_msg,true));
  if(!empty($err_msg)){
    
    //文字化けしないよう設定
    mb_language("Japanese"); //現在使っている言語を設定する
    mb_internal_encoding("UTF-8");
    
    $to = 'ymnkknt3@gmail.com';
    
    //メール送信
    $result = mb_send_mail($to, $name, $message, "From : ".$email);
    
    debug('センドメール'.print_r($result,true));
    
    //送信結果を判定
    if($result){
      unset($_POST);
      $_SESSION['msg_success'] = SUC03;
    }else{
      $_SESSION['msg_success'] = MSG18;
    }
  }
}

debug('画面表示処理終了 <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<');
?>

<!--ヘッダータグ-->
<?php 
$siteTitle ='HOME';
require('head.php');
?>

<body class="page-toppage page-1colum">


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

  <!-- メインコンテンツ -->
  <div id="contents" class="site-width">

    <h1 class="page-title">お問い合わせ</h1>
  
<!--  Main-->
    <section id="main">
      <div class="form-container">
        <form action="" method="post" class="form">
<!--         共通エラーメッセージ-->
          <div class="area-msg">
           <?php if(!empty($err_msg['common'])) echo $err_msg['common']; 
           ?>
          </div>
<!--           お名前-->
            <label class="<?php if(!empty($err_msg['name'])) echo 'err'; ?>">
              お名前
              <input type="text" name="name" value="<?php getFormData('name'); ?>">
            </label>
            <div class="area-msg">
              <?php if(!empty($err_msg['name'])) echo $err_msg['name']; ?>
            </div>
<!--           メールアドレス-->
          <label class="<?php if(!empty($err_msg['email'])) echo 'err'; ?>">
            email
            <input type="text" name="email" value="<?php getFormData('email'); ?>">
          </label>
          <div class="area-msg">
            <?php if(!empty($err_msg['email'])) echo $err_msg['email']; ?>
          </div>
          
<!--          お問い合わせ内容-->
          <label class="<?php if(!empty($err_msg['message'])) echo 'err'; ?>">
            お問い合わせ内容
            <textarea name="message" id="" cols="30" rows="10" value="" style="height:300px;"></textarea>
          </label>
          <div class="area-msg">
            <?php if(!empty($err_msg['message'])) echo $err_msg['message']; ?>
          </div>
         
<!--         送信ボタン-->
          <div class="btn-container">
            <input type="submit" class="btn btn-mid" value="送信">
          </div>
         
        </form>
      </div>
    </section>

































