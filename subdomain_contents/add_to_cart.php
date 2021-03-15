<?php
    class add_to_cart{
        function addProduct($pid, $qty)
        {
            if(isset($_SESSION['cart'][$pid]))
            {
                $_SESSION['cart'][$pid]['qty']+=$qty;
            }
            else
            {
                $_SESSION['cart'][$pid]['qty']=$qty;
            }
            
        }
        // function updateProduct($pid, $qty)
        // {
        //     if(isset($_SESSION['cart'][$pid]))
        //     {
        //         $_SESSION['cart'][$pid]['qty']-=$qty;
        //     }
        // }
        function removeProduct($pid, $qty)
        {
            if(isset($_SESSION['cart'][$pid]) && $_SESSION['cart'][$pid]['qty']==1)
            {
                unset($_SESSION['cart'][$pid]);
            }
            else if(isset($_SESSION['cart'][$pid]) && $_SESSION['cart'][$pid]['qty']>1)
            {
                $_SESSION['cart'][$pid]['qty']-=$qty;
            }
        }
        function emptyProduct($pid, $qty)
        {
            unset($_SESSION['cart'][$pid]);
        }
        function totalProduct()
        {
            if(isset($_SESSION['cart']))
            {
                $count=0;
                foreach ($_SESSION['cart'] as $key => $val) {
                    $count += $val['qty'];
                }
                return $count;
            }
            else
            {
                return 0;
            }
        }
    }
?>