<?php
if(isset($_SESSION['user']))
{
    $user = $_SESSION['user'];
}
else
    $user=null;
?>
<header>
    <div class="navbar">
        <div class="nav-logo border">
            <div class="logo">
                <a href="home.php">Sell & Buy</a>
            </div>
        </div>

        <div class="nav-acc border">
            <a href="login.php">
                <div class="acc">
                Hello, <span><?php echo isset($user)? $user :"SignIn"?></span>
                </div>
            </a>
            <span>
            <?php
            if(isset($user))
            {
                echo 'Want to <a href="logout.php">logout</a>';
            }
            ?>
            </span>
        </div>

        <div class="cart border">
            <a href="cart.php">
            <i class="fa-solid fa-cart-shopping"></i>
             Cart
            </a>
        </div>
    </div>

    <div class="navbar2">
        <div class="nav2">
            <a href="shop.php">Shop</a>
        </div>
        <div class="nav2">
            <a href="orders.php">Order</a>
        </div>
        <div class="nav2">
            <a href="contact.php">Contact</a>
        </div>

        <div class="sell border2">
            <a href="sell.php">Sell</a>
        </div>
    </div>
</header>
</html>