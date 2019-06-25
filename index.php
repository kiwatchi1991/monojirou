
<?php 
  //共通変数・関数ファイルを読込み
  require('function.php');

debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debug('「　TOPページ　」');
debug('」」」」」」」」」」」」」」」」」」」」」」」」」」」」」」」」');
debugLogStart();


//ログイン認証
//require('auth.php');

//<!--headタグ-->
$siteTitle = 'TOP';
require('head.php');
?>


<body id="index">

  <div id="bg_blk">
  </div>

<!--ヘッダ(ロゴのみなのでべた書き)-->
  <header>
    <div class="site-width">
      <div class="logo">
        <a href='index.php'><img src="images/Monojirou.png" alt="ロゴ"></a>
      </div>
    </div>
  </header>



<!--wrap始まり-->
<div id="wrap">
  <div class="content">
<!--
    <h1>現場を支える</h1>
    <h1>ネットストア</h1>
-->

    <p>このwebサイトは、工具専門の出品サイトです。</p>
    
    
    
    
    <div id="btn">
      <p class="btn"><a href="signup.php">ユーザー登録</a></p>
      <p class="btn"><a href="login.php">ログイン</a></p>
    </div>
    
    </div>
</div>
<!--wrap終わり-->
    
    
    <!--ヘッダー-->
    <?php 
    require('footer.php');
    ?>
    
</body>
</html>