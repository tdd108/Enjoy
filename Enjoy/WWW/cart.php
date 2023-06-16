  <div class="dropdown-content">
    <?php if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) : ?>
        <?php foreach(array_keys($_SESSION['cart']) as $key) :?>
            <h2 style="font-size : 18px;"><?php echo $key;?></h2><br>
            <?php foreach(array_keys($_SESSION['cart'][$key]) as $key2) :?>
                <p>
                    <p><?php echo $key2." QUANTITY : ".$_SESSION['cart'][$key][$key2][0];?><p>
                    <form action="" method = "post">
                        <button type="submit" name="delete" value = "<?php echo $key2?>">Remove</button>
                    </form>
                    <?php
                      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                          if(isset($_POST['delete'])){
                              unset($_SESSION['cart'][$key][$_POST['delete']]);
                              if(count($_SESSION['cart'][$key]) == 0){
                                unset($_SESSION['cart'][$key]);
                              }
                          }
                      }
                    ?>
                </p>
            <?php endforeach;?>
        <?php endforeach;?>
        <form action="<?php echo file_exists('payment.php') ? '': '../../' ?>payment.php" method ="post">
          <button type="submit" name="commander" value="Commander">Commander</button>
        </form>
    <?php else : ?>
      <?php echo "votre panier est vide";?>
    <?php endif;?>
  </div>
</div>

