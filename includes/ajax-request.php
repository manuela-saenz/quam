<?php
require_once(get_template_directory() . '/functions.php');

// use Dompdf\Dompdf;


// $response = array();
// ini_set('display_errors', 1);
// ini_set('log_errors', 0);
// error_reporting(E_ALL);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class SyEAjaxRequest
{
    private $woocomerce;

    public function __construct()
    {

        $actions = array(
            "send_mail_contact",
            "woocommerce_ajax_add_to_cart",
            "woocommerce_ajax_add_to_cart_category",
            "woocommerce_ajax_add_to_cart_remplace_qty",
            "woocommerce_ajax_add_to_cart_single",
            "woocommerce_remove_cart_item",
            "woocommerce_remove_cart_item_qty",
            "woocommerce_ajax_favorites",
            "add_product_to_favorites",
            "delete_favorite_product"
        );



        foreach ($actions as $act) {
            add_action("wp_ajax_nopriv_{$act}", array($this, $act));
            add_action("wp_ajax_{$act}", array($this, $act));
        }
    }

    function send_mail_contact()
    {
        $txtName = $_POST['name'];
        $txtPhone = $_POST['phone'];
        $txtEmail = $_POST['email'];
        $txtMessage = $_POST['message'];
        $txtConsult = $_POST['consult'];

        $headers[] = 'Content-Type: text/html; charset=UTF-8';
        $headers[] = 'From: Quam contacto';

        ob_start();
        include get_template_directory() . '/includes/bodyMails/contact-form-client.php';
        $body = ob_get_clean();

        $mail1 = wp_mail($txtEmail, "Lo que nos cuentas es importante para nosotros", $body, $headers);

        $receptorEmail = 'legiestsas@gmail.com';
        ob_start();
        include get_template_directory() . '/includes/bodyMails/admin-mail-restor.php';
        $bodyReceptor = ob_get_clean();

        $mail2 = wp_mail($receptorEmail, "Alguien quiere contactarse con Quam", $bodyReceptor, $headers);

        if ($mail1 && $mail2) {
            http_response_code(200);
            echo json_encode(array(
                'status' => '200',
                'message' => 'Mensajes enviados correctamente'
            ));
        } else {
            http_response_code(500);
            echo json_encode(array(
                'status' => '500',
                'message' => 'Error al enviar los mensajes'
            ));
        }
        exit;
    }
   
    function verifyCoupon($applied_coupons)
    {
        global $woocommerce;

        $coupon_details = array();

        foreach ($applied_coupons as $code) {
            $coupon = new WC_Coupon($code);
            $amount = $woocommerce->cart->get_coupon_discount_amount($coupon->get_code(), $woocommerce->cart->display_cart_ex_tax);
            $coupon_details[] = array(
                'title' => $coupon->get_code(),
                'value' => $amount
            );
        }
        return $coupon_details;
    }

    function woocommerce_ajax_add_to_cart()
    {
        global $woocommerce;

        $prodID = $_POST["product_id"];
        $quantity = $_POST["quantity"];
        $result = $woocommerce->cart->add_to_cart($prodID, $quantity);

        $itemsCount = $woocommerce->cart->get_cart_contents_count();
        $total_discount = 0;
        $applied_coupons = $woocommerce->cart->get_applied_coupons();
        $coupon_details = $this->verifyCoupon($applied_coupons);

        // Ahora, $coupon_details es un array que contiene los detalles de todos los cupones aplicados
        $ValorTotalSinDescuento = $woocommerce->cart->get_cart_subtotal();
        $ValorTotal = $woocommerce->cart->get_cart_total();
        $DescuentoTotal = $woocommerce->cart->get_total_discount();

        ob_start();
        ItemsCart();
        $itemsCart = ob_get_clean();
        $buffer = preg_replace('/<!--(.|\s)*?-->/', '', $itemsCart);

        echo json_encode(
            array(
                "item" => $result,
                "status" => "success",
                "html" => $buffer,
                "counter" => count($woocommerce->cart->get_cart()),
                "total" => $ValorTotal,
                "coupon_details" => $coupon_details,
                "discount" => $DescuentoTotal,
                "quantity" => $itemsCount,
                "subtotal" => $ValorTotalSinDescuento,
                "discount_amount" => $total_discount
            )
        );
        wp_die();
    }

    function woocommerce_ajax_add_to_cart_category()
    {
        global $woocommerce;

        $prodID = $_POST["product_id"];
        $quantity = $_POST["quantity"];
        $result = $woocommerce->cart->add_to_cart($prodID, $quantity - 1);

        $itemsCount = $woocommerce->cart->get_cart_contents_count();
        $total_discount = 0;
        $applied_coupons = $woocommerce->cart->get_applied_coupons();
        $coupon_details = $this->verifyCoupon($applied_coupons);

        // Ahora, $coupon_details es un array que contiene los detalles de todos los cupones aplicados
        $ValorTotalSinDescuento = $woocommerce->cart->get_cart_subtotal();
        $ValorTotal = $woocommerce->cart->get_cart_total();
        $DescuentoTotal = $woocommerce->cart->get_total_discount();

        ob_start();
        ItemsCart();
        $itemsCart = ob_get_clean();
        $buffer = preg_replace('/<!--(.|\s)*?-->/', '', $itemsCart);

        echo json_encode(
            array(
                "item" => $result,
                "status" => "success",
                "html" => $buffer,
                "counter" => count($woocommerce->cart->get_cart()),
                "total" => $ValorTotal,
                "coupon_details" => $coupon_details,
                "discount" => $DescuentoTotal,
                "quantity" => $itemsCount,
                "subtotal" => $ValorTotalSinDescuento,
                "discount_amount" => $total_discount
            )
        );
        wp_die();
    }

    function woocommerce_ajax_add_to_cart_remplace_qty()
    {
        global $woocommerce;

        $prodID = $_POST["product_id"];
        $quantity = $_POST["quantity"];


        $cartItemKey = null;

        foreach ($woocommerce->cart->get_cart() as $key => $cart_item) {
            if ($cart_item['product_id'] == $prodID || (isset($cart_item['variation_id']) && $cart_item['variation_id'] == $prodID)) {
                $cartItemKey = $key;
                break;
            }
        }

        if ($cartItemKey) {
            $woocommerce->cart->set_quantity($cartItemKey, $quantity);
        }

        $totalItemsProduct = $woocommerce->cart->get_cart_item($cartItemKey)["quantity"];
        $PrecioProducto = $woocommerce->cart->get_cart_item($cartItemKey)["data"]->get_price();
        $TotalProduct = $totalItemsProduct * $PrecioProducto;

        $formatoColombiano = "$ " . number_format($TotalProduct, 0, ',', '.');

        $ValorTotalSinDescuento = $woocommerce->cart->get_cart_subtotal();
        $ValorTotal = $woocommerce->cart->get_cart_total();
        $DescuentoTotal = $woocommerce->cart->get_total_discount();


        ob_start();
        ItemsCart();
        $itemsCart = ob_get_clean();

        $search = array(
            '/\>[^\S ]+/s',     // strip whitespaces after tags, except space
            '/[^\S ]+\</s',     // strip whitespaces before tags, except space
            '/(\s)+/s',         // shorten multiple whitespace sequences
            '/<!--(.|\s)*?-->/' // Remove HTML comments
        );
        $replace = array(
            '>',
            '<',
            '\\1',
            ''
        );

        $buffer = preg_replace($search, $replace, $itemsCart);
        $shipping_total = $woocommerce->cart->get_cart_shipping_total();
        $applied_coupons = $woocommerce->cart->get_applied_coupons();
        $coupon_details = $this->verifyCoupon($applied_coupons);
        echo json_encode(
            array(
                "item" => $cartItemKey,
                "status" => "success",
                "html" => $buffer,
                'subtotal' => $ValorTotalSinDescuento,
                "coupon_details" => $coupon_details,
                'discount' => $DescuentoTotal,
                "total" => $ValorTotal,
                "shipping_total" => $shipping_total,
                "quantity" => count($woocommerce->cart->get_cart()),
                "totalProducto" => $formatoColombiano
            )
        );
        die();
    }

    function woocommerce_ajax_add_to_cart_single()
    {
        global $woocommerce;

        $prodID = $_POST["product_id"];
        $variantID = $_POST["product_variant"];
        $quantity = $_POST["quantity"];

        $product = wc_get_product($variantID ? $variantID : $prodID); // Obtén la variante del producto si existe

        if (!$product) {
            echo json_encode(
                array(
                    "status" => "error",
                    "message" => "Producto no encontrado"
                )
            );
            die();
        }

        if (!$product->is_in_stock()) {
            echo json_encode(
                array(
                    "status" => "error",
                    "message" => "Agotado. Por favor elige un producto diferente."
                )
            );
            die();
        }

        // Busca y elimina cualquier instancia previa del mismo producto en el carrito
        foreach ($woocommerce->cart->get_cart() as $cart_item_key => $cart_item) {
            if ($cart_item['product_id'] == $prodID) {
                $woocommerce->cart->remove_cart_item($cart_item_key);
            }
        }

        // Agrega el producto al carrito con la nueva cantidad
        $result = $woocommerce->cart->add_to_cart($product->get_id(), $quantity);
        $totalItemsProduct = $woocommerce->cart->get_cart_item($result)["quantity"];
        $PrecioProducto = $woocommerce->cart->get_cart_item($result)["data"]->get_price();
        $TotalProduct = $totalItemsProduct * $PrecioProducto;
        $formatoColombiano = "$ " . number_format($TotalProduct, 0, ',', '.');

        $ValorTotal = $woocommerce->cart->get_cart_total();

        ob_start();
        ItemsCart();
        $itemsCart = ob_get_clean();

        ob_start();
        trItemsCart();
        $anotherOutput = ob_get_clean();

        $search = array(
            '/\>[^\S ]+/s',
            '/[^\S ]+\</s',
            '/(\s)+/s',
            '/<!--(.|\s)*?-->/'
        );
        $replace = array(
            '>',
            '<',
            '\\1',
            ''
        );

        $buffer = preg_replace($search, $replace, $itemsCart);
        $buffer2 = preg_replace($search, $replace, $anotherOutput);

        echo json_encode(
            array(
                "item" => $result,
                "status" => "success",
                "html" => $buffer,
                "ordenList" => $buffer2,
                "total" => $ValorTotal,
                "quantity" => count($woocommerce->cart->get_cart()),
                "totalProducto" => $formatoColombiano
            )
        );

        wp_die();
    }


    function woocommerce_remove_cart_item()
    {
        global $woocommerce;
        $cart_variation_key = $_POST["cart_item_key"];
        $cart_product_key = $_POST["product_id"];

        foreach ($woocommerce->cart->get_cart() as $key => $cart_item) {
            if ($cart_item['variation_id'] == $cart_variation_key) {
                unset($woocommerce->cart->cart_contents[$key]);
                $woocommerce->cart->calculate_totals();
                break;
            }
        }

        if ($cart_variation_key === 0) {
            $woocommerce->cart->remove_cart_item($cart_product_key);
        }

        $ValorTotal = $woocommerce->cart->get_cart_total();
        $DescuentoTotal = $woocommerce->cart->get_total_discount();
        $itemsCount = $woocommerce->cart->get_cart_contents_count();


        ob_start();
        ItemsCart();
        $itemsCart = ob_get_clean();

        $search = array(
            '/\>[^\S ]+/s',     // strip whitespaces after tags, except space
            '/[^\S ]+\</s',     // strip whitespaces before tags, except space
            '/(\s)+/s',         // shorten multiple whitespace sequences
            '/<!--(.|\s)*?-->/' // Remove HTML comments
        );
        $replace = array(
            '>',
            '<',
            '\\1',
            ''
        );

        $buffer = preg_replace($search, $replace, $itemsCart);

        $applied_coupons = $woocommerce->cart->get_applied_coupons();
        $coupon_details = $this->verifyCoupon($applied_coupons);

        echo json_encode(
            array(
                "status" => "success",
                "html" => $buffer,
                // "ordenList" => $buffer,
                "coupon_details" => $coupon_details,
                "total" => $ValorTotal,
                "counter" => count($woocommerce->cart->get_cart()),
                "discount" => $DescuentoTotal,
                "quantity" => $itemsCount
            )
        );

        wp_die();
    }

    function woocommerce_remove_cart_item_qty()
    {
        global $woocommerce;
        $cart_item_key = $_POST["cart_item_key"];
        $cuanty = intval($_POST["cuanty"]);
        if ($cuanty == 0) {
            echo json_encode(
                array(
                    "status" => "error",
                    "message" => "La cantidad no puede ser 0"
                )
            );
        }


        $current_quantity = $woocommerce->cart->get_cart_item($cart_item_key)["quantity"];

        $new_quantity = max(0, $current_quantity - $cuanty);

        $result = $woocommerce->cart->set_quantity($cart_item_key, $new_quantity, true);

        $totalItemsProduct = $woocommerce->cart->get_cart_item($cart_item_key)["quantity"];
        $PrecioProducto = $woocommerce->cart->get_cart_item($cart_item_key)["data"]->get_price();
        $TotalProduct = $totalItemsProduct * $PrecioProducto;

        $formatoColombiano = "$ " . number_format($TotalProduct, 0, ',', '.');

        $ValorTotal = $woocommerce->cart->get_cart_total();

        ob_start();
        ItemsCart();
        $itemsCart = ob_get_clean();

        $search = array(
            '/\>[^\S ]+/s',     // strip whitespaces after tags, except space
            '/[^\S ]+\</s',     // strip whitespaces before tags, except space
            '/(\s)+/s',         // shorten multiple whitespace sequences
            '/<!--(.|\s)*?-->/' // Remove HTML comments
        );
        $replace = array(
            '>',
            '<',
            '\\1',
            ''
        );

        $buffer = preg_replace($search, $replace, $itemsCart);

        echo json_encode(
            array(
                "item" => $result,
                "status" => "success",
                "html" => $buffer,
                "totalProducto" => $formatoColombiano,
                "total" => $ValorTotal,
                // Añade el total del envío a la respuesta
                "quantity" => count($woocommerce->cart->get_cart())
            )
        );

        wp_die();
    }


    function woocommerce_ajax_favorites()
    {
        $id_user = intval($_POST["id_user"]);
        $id_product = intval($_POST["id_product"]);

        $table = "wc_favorites";

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("SELECT * FROM $table WHERE id_user = ? AND id_producto = ?");
        $stmt->bind_param("ii", $id_user, $id_product);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $stmt = $conn->prepare("DELETE FROM $table WHERE id_user = ? AND id_producto = ?");
            $stmt->bind_param("ii", $id_user, $id_product);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                echo json_encode(
                    array(
                        "status" => "success",
                        "message" => "Producto eliminado de favoritos"
                    )
                );
            } else {
                echo json_encode(
                    array(
                        "status" => "error",
                        "message" => "Error al eliminar el producto de favoritos"
                    )
                );
            }
        } else {
            $stmt = $conn->prepare("INSERT INTO $table (`id_user`, `id_producto`, `created-at`)
                VALUES (?, ?, NOW())");
            $stmt->bind_param("ii", $id_user, $id_product);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                echo json_encode(
                    array(
                        "status" => "success",
                        "message" => "Producto agregado a favoritos"
                    )
                );
            } else {
                echo json_encode(
                    array(
                        "status" => "error",
                        "message" => "Error al agregar el producto a favoritos"
                    )
                );
            }
        }


        $stmt->close();
        $conn->close();
        die();
    }

   
    public function add_product_to_favorites()
    {
        session_start();
        $prodID = $_POST["prodid"];
        $sessionName = "prodsfavs";

        if (!isset($_SESSION[$sessionName]) || empty($_SESSION[$sessionName])) {
            $prodsFavs = array($prodID);
            $_SESSION[$sessionName] = $prodsFavs;
        } else {
            if (!in_array($prodID, $_SESSION[$sessionName])) {
                $_SESSION[$sessionName][] = $prodID;
            }
        }

        ob_start();
        get_template_part("templates/components/mini", "favs");
        $html = ob_get_clean();

        header('Content-Type: application/json');
        echo json_encode(
            array(
                "html" => $html,
                "counter" => count($_SESSION[$sessionName])
            )
        );

        wp_die();
    }

    public function delete_favorite_product()
    {

        session_start();
        $sessionName = "prodsfavs";

        $prodID = $_POST["prodid"];
        $keyProdIDFind = array_search($prodID, $_SESSION[$sessionName]);

        unset($_SESSION[$sessionName][$keyProdIDFind]);

        ob_start();
        get_template_part("templates/components/mini", "favs");
        $html = ob_get_clean();

        header('Content-Type: application/json');
        echo json_encode(
            array(
                "html" => $html,
                "counter" => count($_SESSION[$sessionName])
            )
        );

        wp_die();
    }
   

   

   

    

   
}



new SyEAjaxRequest();
