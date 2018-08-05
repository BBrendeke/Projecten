<?php
  include 'php_functies/indexHeader.php';
?>
<div>
  <div class="flex-info">
    <div class="textBox">
      <form name="log" action="login.php" method="post">
        <label class="red"> Username: </label><br>
          <input type="text" name="user"/><br>
        <label class="red"> Wachtwoord: </label><br>
          <input  type="password" name="password"/><br>
        <input name="submit" type="submit" value="Submit">
      </form>
    </div>
  </div>
</div>
<?php
    include 'php_functies/indexFooter.php';
?>
