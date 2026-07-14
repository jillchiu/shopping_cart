<?php

    session_start();

    $products = [
        ['id' => 1, 'name' => 'Apple', 'img' => 'apple.png', 'variety' => 'Wasefuji', 'made_in' => 'Aomori', 'price' => 5.00],
        ['id' => 2, 'name' => 'Mikan', 'img' => 'mikan.png', 'variety' => 'Unshyuu', 'made_in' => 'Shizuoka', 'price' => 3.00],
        ['id' => 3, 'name' => 'Strawberry', 'img' => 'strawberry.jpg', 'variety' => 'Amaou', 'made_in' => 'Fukuoka', 'price' => 3.00],
        ['id' => 4, 'name' => 'Peach', 'img' => 'peach.jpg', 'variety' => 'Akatsuki', 'made_in' => 'Fukushima', 'price' => 8.00],
        ['id' => 5, 'name' => 'Grape', 'img' => 'grape.jpeg', 'variety' => 'Kyohou', 'made_in' => 'Nagano', 'price' => 5.00],
        ['id' => 6, 'name' => 'Mango', 'img' => 'mango.png', 'variety' => 'Appurumango', 'made_in' => 'Kagoshima', 'price' => 20.00],
    ];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        foreach ($products as $product) {
            $increaseQuantity = "increase_quantity{$product['id']}";
            $decreaseQuantity = "decrease_quantity{$product['id']}";    
            if (isset($_POST[$increaseQuantity]) || isset($_POST[$decreaseQuantity]) ) {
                $existingCartItem = array_filter($_SESSION['cart'], function ($item) use ($product) {
                    return $item['id'] === $product['id'];
                });
    
                if (!empty($existingCartItem)) {
                    // product exist, quantity++
                    if(isset($_POST[$increaseQuantity])){
                        $_SESSION['cart'][key($existingCartItem)]['quantity']++;
                    }elseif($_SESSION['cart'][key($existingCartItem)]['quantity'] > 1){
                        $_SESSION['cart'][key($existingCartItem)]['quantity']--;
                    }
                } else {
                    // product not exist, create cart
                    $_SESSION['cart'][] = [
                        'id' => $product['id'],
                        'name' => $product['name'],
                        'img' => $product['img'],
                        'variety' => $product['variety'],
                        'made_in' => $product['made_in'],
                        'price' => $product['price'],
                        'quantity' => 1,
                    ];
                }
            }
        }
    
        if (isset($_POST['remove_from_cart'])) {
            $productIdToRemove = $_POST['remove_from_cart'];
            $_SESSION['cart'] = array_filter($_SESSION['cart'], function ($item) use ($productIdToRemove) {
                return $item['id'] != $productIdToRemove;
            });
        }

        if (isset($_POST['empty'])) {
            foreach ($_SESSION['cart'] as $cartItem) {
                $productIdToRemove = $cartItem['id'];
                $_SESSION['cart'] = array_filter($_SESSION['cart'], function ($item) use ($productIdToRemove) {
                    return $item['id'] != $productIdToRemove;
                });
            }
        };

        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();

    }

    $total_price = array_sum(array_map(function ($item) {
        return $item['price'] * $item['quantity'];
    }, $_SESSION['cart']));
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <title>Jill online fruit store</title>
    <div class="head">
        <h3 id="head_title">Jill Online Fruit Store</h3>
        <nav class="header-nav">
            <ul id="head_link">
                <li>
                    <a href="#a">Home</a>
                </li>
                <li>
                    <a href="#a">Products</a>
                </li>
                <li>
                    <a href="#" id="openCart">Cart</a>
                </li>
            </ul>

        </nav>
    </div>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>

    <div class="products">

        <div id="grid-selector">
            <h1>Products</h1>
        </div>

        <div id="grid" >

            <?php foreach ($products as $product): ?>

                <div class="product">

                    <?php echo "<img class='productImage' src='./img/".$product['img']."' alt='".$product['name']."' />" ?>
                    <div class="image_overlay" id="image_overlay_<?php echo $product['id']; ?>" value="<?php echo $product['id']; ?>"></div>
                    
                    <button type="submit" class="add_to_cart increaseButton" id="add_to_cart_<?php echo $product['id']; ?>" value="increase_quantity<?php echo $product['id']; ?>">Add to Cart</button>

                    <div class="stats">
                        <div class="stats-container" id="stats-container_<?php echo $product['id']; ?>">
                            <span class="product_price">$<?php echo $product['price']; ?></span>
                            <span class="product_name"><?php echo $product['name']; ?></span>
                            <p>Variety : <?php echo $product['variety']; ?></p>

                            <div class="product-options" id="product-options_<?php echo $product['id']; ?>">
                                <strong>Description</strong>
                                <span>Made in <?php echo $product['made_in']; ?></span>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>

        </div>
    </div>

    <div class="products2">
        <div class="shopping-cart">
            <h3>CART<i class="bi bi-cart"></i><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
              </svg>
                <img id="closeCart" width="24" height="24" src="https://img.icons8.com/material-outlined/24/filled-minus-2-math.png" alt="filled-minus-2-math" />
            </h3>

            <div class="shopping-cart-head">
                <?php

                    $cartItemCount = count($_SESSION['cart']);
                    if ($cartItemCount > 0) {
                        echo "<span class='product-quantity'>".$cartItemCount."</span> Product(s) in cart.<br/><br/>";
                    } else {
                        echo "<span class='product-quantity'>0</span> Product(s) in cart.<br/><br/>";
                    }

                ?>        

                <table style="width:100%;">
                    <?php foreach ($_SESSION['cart'] as $cartItem): ?>
                        <tr style="width:100% !important;">
                            <td style="width:5% !important;">
                                <?php echo "<img src='./img/".$cartItem['img']."' alt='".$product['name']."' style='width:25px; height: 25px;'/>" ?>
                            </td>
                            <td style="width:10% !important;">
                                <?php echo $cartItem['name']; ?>
                            </td>
                            <td style="width:5% !important;">
                                $<?php echo $cartItem['price']; ?>
                            </td>
                            <td style="width:70% !important; text-align:center;">
                                <?php echo array_key_exists('quantity', $cartItem) ? "x 
                                <button type='submit' class='decreaseButton' title='Decrease' value='decrease_quantity".$cartItem['id']."'>-</button>
                             {$cartItem['quantity']}" : ""; ?>
                                <button type="submit" class="increaseButton" title="Increase" value="increase_quantity<?php echo $cartItem['id']; ?>">+</button>
                            </td>
                            <td style="width:5% !important;">
                                <button type="submit" class="removeButton" title="Remove" value="<?php echo $cartItem['id']; ?>" style="background-color:red; color:white;">&times</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                
                <br/><br/>
                <?php

                    echo ($cartItemCount > 0) ? "<p>Total Price: $".$total_price."</p>" : "";

                ?>
            </div>
            <div class="cart-buttons">
                <?php

                    if($cartItemCount > 0){
                        echo "<button type='submit' id='payButton' class='button ' style='width:50%; text-decoration: none; text-align:center;'>Pay</button>";
                        echo "<button type='submit' id='emptyButton' class='button ' style='width:50%; text-decoration: none; text-align:center; background: rgb(197, 83, 83);'>Empty</button>";
                    }
                
                ?>
            </div>
        </div>
    </div>
    
    <script src="./js/script.js"></script>

</body>


</html>