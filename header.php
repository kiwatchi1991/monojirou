<header>
  <div class="site-width">
    <div class="logo">
        <a href='index.php'><img src="images/Monojirou-cutout.png" alt="ロゴ"></a>
    </div>
    <nav id="top-nav">
      <ul>
        <?php 
          if(empty($_SESSION['user_id'])){
        ?>
            <li><a href="signup.php" class="btn-signup">
              <img src="images/wakaba.png" alt="若葉マーク" class="wakaba-icon"> 初めてのお客様へ <span class="sign-up">新規登録</span></a></li>
            <li><a href="login.php" class="btn-login">ログイン</a></li>
        <?php 
          }else{
        ?>
        <li><a href="mypage.php" class="btn-mypage">マイページ</a></li>
        <li><a href="logout.php" class="btn-logout">ログアウト</a></li>
        <li><a href="" class="btn-contact">お問い合わせ</a></li>
        <li><a href="" class="btn-qa">よくあるご質問</a></li>
        <?php 
          }
        ?>
        
      </ul>
    </nav>
  </div>
</header>