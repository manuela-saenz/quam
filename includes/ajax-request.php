<?php
require_once (get_template_directory() . '/functions.php');
// require_once(get_template_directory() . '/includes/mail/PHPMailer.php');
// require_once(get_template_directory() . '/includes/mail/SMTP.php');
// require_once(get_template_directory() . '/includes/mail/Exception.php');
// $autoloadPath = get_template_directory() . '/vendor/autoload.php';

// use PHPMailer\PHPMailer\DeliriosPHPMailer;
// use PHPMailer\PHPMailer\DeliriosSMTP;
// use PHPMailer\PHPMailer\DeliriosException;
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
            "woocommerce_ajax_add_to_cart",
            "woocommerce_ajax_add_to_cart_remplace_qty",
            "woocommerce_ajax_add_to_cart_single",
            "woocommerce_remove_cart_item",
            "woocommerce_remove_cart_item_qty",
            "woocommerce_ajax_search",
            "woocommerce_generate_order",
            "woocommerce_confirm_payment",
            "woocommerce_ajax_favorites",
            "woocommerce_ajax_descargar_pdf",
            "process_paymentU",
            "process_payAddi",
            "add_product_to_favorites",
            "delete_favorite_product",
            "recoverPassword",
            "changeInfoProfile",
            "resetPassword",
            "ChangePasswordProfile",
            "register",
            "login",
            "logout",
        );



        foreach ($actions as $act) {
            add_action("wp_ajax_nopriv_{$act}", array($this, $act));
            add_action("wp_ajax_{$act}", array($this, $act));
        }
    }

    function process_payAddi()
    {

        $ally_slug = 'quamstore-ecommerce';
        $amount = $_POST["amount"];

        function get_addi_config($ally_slug, $amount)
        {
            $url = "https://channels-public-api.addi.com/allies/{$ally_slug}/config?requestedAmount={$amount}";
            $response = file_get_contents($url);

            // Decodificar la respuesta JSON
            $data = json_decode($response, true);

            return $data;
        }


        $data = get_addi_config($ally_slug, $amount);
        if ($data['minAmount'] > $amount) {
            $response = array(
                'success' => false,
                'message' => 'El monto minimo para pagar con Addi es de ' . $data['minAmount']
            );
            echo json_encode($response);
            exit();
        }

        // Generate JWT Auth Addi
        function get_addi_token()
        {
            $url = "https://auth.addi-staging.com/oauth/token";

            $data = array(
                "audience" => "https://api.staging.addi.com",
                "grant_type" => "client_credentials",
                "client_id" => "TasR27VSFVAY9k7fewhPWIAi0Sv3bvy1",
                "client_secret" => "5kzge06cigvhvngl9JnUaIgLBu4dsFeaKXyyak8eU76P7s1GOqaZ21e5nV7cg88J"
            );

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

            $response = curl_exec($ch);

            if (!$response) {
                die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
            }

            curl_close($ch);

            return json_decode($response, true);
        }

        $token = get_addi_token();
        var_dump($token);
    }

    function process_paymentU()
    {
        global $woocommerce;

        // Verifica si se han recibido los datos del formulario AJAX
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["amount"])) {
            // Aquí puedes incluir la lógica para procesar los datos recibidos y construir el formulario de PayU
            // Recibe los datos del formulario AJAX
            $amount = $_POST["amount"];
            $referenceOrder = $_POST["reference"];
            $email = $_POST["email"];
            $city = $_POST["city"];
            $city = $_POST["city"];
            $address = $_POST["address"];
            $neighborhood = $_POST["neighborhood"];


            $apikey = '3Fe1XI463W6gVi6Wdo93zBi1Px';
            $merchantId = '975355';
            $reference = $referenceOrder;
            $price = $amount;
            $currency = 'COP';

            $signature = md5($apikey . '~' . $merchantId . '~' . $reference . '~' . $price . '~' . $currency);
            // Lógica adicional para construir el formulario de PayU
            // ...

            // Construye el formulario de PayU (este es solo un ejemplo, asegúrate de incluir los campos correctos)
            $payu_form = '<form id="payu-form" action="https://gateway.payulatam.com/ppp-web-gateway/" method="POST">';
            $payu_form .= '<input type="hidden" name="merchantId" value="975355">';
            $payu_form .= '<input type="hidden" name="accountId" value="983288">';
            $payu_form .= '<input type="hidden" name="description" value="Pedido Quam #' . $referenceOrder . '">';
            $payu_form .= '<input type="hidden" name="tax" value="0.00">';
            $payu_form .= '<input type="hidden" name="referenceCode" value="' . $reference . '">';
            $payu_form .= '<input type="hidden" name="amount" value="' . $amount . '">';
            $payu_form .= '<input type="hidden" name="taxReturnBase" value="0">';
            $payu_form .= '<input type="hidden" name="currency" value="COP">';
            $payu_form .= '<input type="hidden" name="signature" value="' . $signature . '">';
            $payu_form .= '<input type="hidden" name="test" value="0">';
            $payu_form .= '<input type="hidden" name="buyerEmail" value="' . $email . '">';
            $payu_form .= '<input type="hidden" name="responseUrl" value="https://www.quam.com.co/web_quam/wp-content/plugins/woocommerce-payu-latam/response.php">';
            $payu_form .= '<input type="hidden" name="confirmationUrl" value="https://www.quam.com.co/web_quam/wp-content/plugins/woocommerce-payu-latam/response.php">';
            $payu_form .= '<input type="hidden" name="shippingCountry" value="CO">';
            $payu_form .= '<input type="hidden" name="billingCountry" value="CO">';
            $payu_form .= '<input type="hidden" name="shippingAddress" value="' . $neighborhood . $address . '">';
            $payu_form .= '<input type="hidden" name="billingAddress" value="' . $neighborhood . $address . '">';
            $payu_form .= '<input type="hidden" name="billingCity" value="' . $city . '">';
            $payu_form .= '<input type="hidden" name="shippingCity" value="' . $city . '">';
            $payu_form .= '<input type="hidden" name="extra1" value="WOOCOMMERCE">';

            $payu_form .= '<input type="submit" value="Pagar con PayU">';
            $payu_form .= '</form>';
            $woocommerce->cart->empty_cart();
            // Devuelve el formulario de PayU como respuesta AJAX
            $response = array(
                'success' => true,
                'form' => $payu_form
            );
            echo json_encode($response);
            wp_die();
        } else {
            // Si los datos no se han recibido correctamente, devuelve un mensaje de error
            $response = array(
                'success' => false,
                'message' => 'Error al procesar la solicitud.'
            );
            echo json_encode($response);
            wp_die();
        }
    }


    function woocommerce_ajax_add_to_cart()
    {
        global $woocommerce;

        $prodID = $_POST["product_id"];
        $quantity = $_POST["quantity"];
        $result = $woocommerce->cart->add_to_cart($prodID, $quantity);

        $ValorTotal = $woocommerce->cart->get_cart_total();
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
                "total" => $ValorTotal
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
        $shipping_total = $woocommerce->cart->get_cart_shipping_total();
        echo json_encode(
            array(
                "item" => $cartItemKey,
                "status" => "success",
                "html" => $buffer,
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
                "status" => "success",
                "html" => $buffer,
                // "ordenList" => $buffer,
                "total" => $ValorTotal,
                "counter" => count($woocommerce->cart->get_cart())
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

    function woocommerce_ajax_search()
    {
        global $woocommerce;
        $search = $_POST["search"];

        if (empty($search)) {
            ob_start();
            ItemsSearchASD(array());
            $itemsSearch = ob_get_clean();
            echo json_encode(
                array(
                    "status" => "success",
                    "SearchInput" => $itemsSearch,
                )
            );
            die();
        }

        $args = array(
            'post_type' => 'product',
            'posts_per_page' => -1,
            's' => $search
        );
        $products_query = new WP_Query($args);

        $products = array();
        foreach ($products_query->posts as $product) {
            $nombre = $product->post_title;
            $id = $product->ID;
            $precio = $product->price;
            $imagen = get_the_post_thumbnail_url($id, "medium");
            $link = get_permalink($id);

            $products[] = array(
                "nombre" => $nombre,
                "id" => $id,
                "precio" => $precio,
                "imagen" => $imagen,
                "link" => $link
            );
        }
        ob_start();
        ItemsSearchASD($products);
        $itemsSearch = ob_get_clean();

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

        $buffer = preg_replace($search, $replace, $itemsSearch);

        echo json_encode(
            array(
                "status" => "success",
                "SearchInput" => $buffer,
            )
        );
        die();
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

    function register()
    {
        $username = $_POST["nombre"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $password2 = $_POST["passwordConfirm"];
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $table = "wp_buyers";

        if (empty($username) || empty($email) || empty($password) || empty($password2)) {
            http_response_code(400);
            echo json_encode(
                array(
                    'status' => '400',
                    'message' => 'Todos los campos son obligatorios'
                )
            );

            die();
        }

        if ($password != $password2) {
            http_response_code(400);
            echo json_encode(
                array(
                    'status' => '400',
                    'message' => 'Las contraseñas no coinciden'
                )
            );
            die();
        }

        $sql = "SELECT * FROM $table WHERE email = '$email'";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            http_response_code(400);
            echo json_encode(
                array(
                    'status' => '400',
                    'message' => 'El email ya esta registrado'
                )
            );
            die();
        }
        $password = $_POST["password"];
        $password_hash = password_hash($password, PASSWORD_DEFAULT);


        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            http_response_code(400);
            echo json_encode(
                array(
                    'status' => '400',
                    'message' => 'El email no es valido'
                )
            );

            die();
        }


        $data = array(
            "username" => $username,
            "email" => $email,
            "password" => $password_hash,
            "created-at" => date("Y-m-d H:i:s"),
            "updated-at" => date("Y-m-d H:i:s")
        );
        $format = array(
            "%s",
            "%s",
            "%s"
        );
        global $wpdb;
        $wpdb->insert($table, $data, $format);

        if (!session_id())
            session_start();
        session_regenerate_id();
        $_SESSION['user_id'] = $wpdb->insert_id;
        $_SESSION['user_login'] = $username;
        $redirect_url = get_permalink(wc_get_page_id('myaccount'));
        echo json_encode(
            array(
                'status' => '200',
                'message' => 'Usuario registrado correctamente',
                'redirect_url' => $redirect_url
            )
        );

        die();
    }

    function login()
    {
        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
        $password = $_POST["password"];

        if (empty($email) || empty($password)) {
            http_response_code(400);
            echo json_encode(
                array(
                    'status' => '400',
                    'message' => 'Todos los campos son obligatorios'
                )
            );
            die();
        }

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if ($conn->connect_error) {
            http_response_code(500);
            echo json_encode(
                array(
                    'status' => '500',
                    'message' => 'Error en la conexión a la base de datos'
                )
            );
            die();
        }
        $table = "wp_buyers";

        $sql = "SELECT * FROM $table WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            http_response_code(400);
            echo json_encode(
                array(
                    'status' => '400',
                    'message' => 'El email no está registrado'
                )
            );
            die();
        }

        $user = $result->fetch_assoc();

        if (!password_verify($password, $user["password"])) {
            http_response_code(400);
            echo json_encode(
                array(
                    'status' => '400',
                    'message' => 'La contraseña es incorrecta'
                )
            );
            die();
        }

        $user_id = $user["id"];

        if (!session_id())
            session_start();
        session_regenerate_id();
        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_login'] = $user["username"];

        $redirect_url = get_permalink(wc_get_page_id('myaccount'));

        http_response_code(200);
        echo json_encode(
            array(
                'status' => '200',
                'message' => 'Usuario autenticado correctamente',
                'redirect_url' => $redirect_url
            )
        );

        exit();
    }

    function logout()
    {
        if (!session_id())
            session_start();

        $_SESSION = array();

        session_destroy();

        wp_redirect(home_url());
        exit();
    }

    function resetPassword()
    {
        $id_user = $_POST["id_user"];
        $password = $_POST["password"];

        if (empty($id_user) || empty($password)) {
            http_response_code(400);
            echo json_encode(
                array(
                    'status' => '400',
                    'message' => 'Todos los campos son obligatorios'
                )
            );
            die();
        }

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        $table = "wp_buyers";

        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "UPDATE $table SET password = '$password_hash' WHERE id = $id_user";

        $result = $conn->query($sql);

        //change status token
        $table = "recovery_password";

        $sql = "UPDATE $table SET status = 1 WHERE id_user = $id_user";

        $result = $conn->query($sql);

        if ($result) {
            echo json_encode(
                array(
                    'status' => '200',
                    'message' => 'Contraseña actualizada correctamente',
                    'redirect_url' => get_permalink(wc_get_page_id('myaccount'))
                )
            );
            die();
        } else {

            echo json_encode(
                array(
                    'status' => '400',
                    'message' => 'Error al actualizar la contraseña'
                )
            );
            die();
        }
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
    function woocommerce_generate_order()
    {
        // $response = array();
        // ini_set('display_errors', 1);
        // ini_set('log_errors', 0);
        // error_reporting(E_ALL);

        global $woocommerce;

        $email = $_POST["email"];
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $telefono = $_POST["telefono"];
        $direccion = $_POST["direccion"];
        $departamento = $_POST["departamento"];
        $barrio = $_POST["barrio"];
        $instrucciones = $_POST["info"];
        $ciudad = $_POST["ciudad"];


        // $this->wc_create_account(array(
        //     "email" => $email,
        //     "nombre" => $nombre,
        //     "apellido" => $apellido,
        //     "telefono" => $telefono,
        //     "direccion" => $direccion,
        //     "apartamento" => $departamento,
        //     "instrucciones" => $instrucciones
        // ));

        $getAllCart = $woocommerce->cart->get_cart();

        $envio = WC()->cart->get_shipping_total();

        $items = array();
        foreach ($getAllCart as $item => $values) {
            $product = wc_get_product($values['product_id']);
            $price = $product->get_price();
            $title = $product->get_title();
            $id_product = $product->get_id();
            $items[] = array(
                "id" => $id_product,
                "title" => $title,
                "price" => $price,
                "quantity" => $values['quantity']
            );
        }

        //create order in woocommerce
        $order = wc_create_order();

        //add products to order
        foreach ($items as $item) {
            $order->add_product(wc_get_product($item["id"]), $item["quantity"]);
        }

        //add shipping to order
        $order->add_shipping(new WC_Shipping_Rate('flat_rate_shipping', 'Envio', $envio, array(), 'flat_rate'));

        //add customer to order

        $order->set_address(
            array(
                'first_name' => $nombre,
                'last_name' => $apellido,
                'email' => $email,
                'phone' => $telefono,
                'address_1' => $direccion,
                'address_2' => $departamento,
                'city' => $ciudad,
                'state' => $barrio,
                'postcode' => '0',
                'country' => 'CO'
            ), 'billing');

        $order->set_address(
            array(
                'first_name' => $nombre,
                'last_name' => $apellido,
                'email' => $email,
                'phone' => $telefono,
                'address_1' => $direccion,
                'address_2' => $departamento,
                'city' => $ciudad,
                'state' => $barrio,
                'postcode' => '0',
                'country' => 'CO'
            ), 'shipping');

        //add payment to order

        $order->set_payment_method('cod');

        //save order
        $order->calculate_totals();
        // en espera
        $order->update_status('waiting');


        //optener el id de la orden
        $order_id = $order->get_id();
        $total_orden = $order->get_total();

        $descripcion_productos = "";

        foreach ($items as $item) {
            $descripcion_productos .= $item["title"] . " x " . $item["quantity"] . ", ";
        }

        $descripcion_productos = substr($descripcion_productos, 0, -2);


        // $this->ConectBuyerAndOrder($email, $order_id);


        $response = array(
            "status" => "success",
            "message" => "Orden creada correctamente",
            "order_id" => $order_id,
            "total" => $total_orden,
            "descripcion_productos" => $descripcion_productos,
        );

        echo json_encode($response);

        die();
    }

    function woocommerce_confirm_payment()
    {
        try {
            // ini_set('display_errors', 1);
            // ini_set('log_errors', 0);
            // error_reporting(E_ALL);

            global $woocommerce;

            $ref_payco = $_POST["ref_payco"];

            $response = wp_safe_remote_get('https://secure.epayco.co/validation/v1/reference/' . $ref_payco);

            if (is_wp_error($response)) {
                throw new Exception('Error al realizar la solicitud.');
            } else {
                $response_body = wp_remote_retrieve_body($response);
                $response_data = json_decode($response_body);



                if ($response_data && isset($response_data->data->x_cod_transaction_state)) {
                    $x_cod_transaction_state = $response_data->data->x_cod_transaction_state;

                    $estado_transaccion = [
                        '1' => 'Aceptada',
                        '2' => 'Rechazada',
                        '3' => 'Pendiente',
                        '4' => 'Fallida',
                        '6' => 'Reversada',
                        '7' => 'Retenida',
                        '8' => 'Iniciada',
                        '9' => 'Caducada',
                        '10' => 'Abandonada',
                        '11' => 'Cancelada',
                    ];

                    if (isset($estado_transaccion[$x_cod_transaction_state])) {
                        $estado_actual = $estado_transaccion[$x_cod_transaction_state];
                        $idenficadorOrden = $response_data->data->x_id_factura;

                        // Verificar si la orden ya existe
                        $order = wc_get_order($idenficadorOrden);

                        if ($order) {
                            // La orden ya existe, actualiza el estado
                            $order->set_transaction_id($idenficadorOrden);

                            // Acciones comunes para 'Aceptada' y 'Rechazada'
                            switch ($estado_actual) {
                                case 'Aceptada':
                                    $order->update_status('completed');
                                    $woocommerce->cart->empty_cart();
                                    break;
                                case 'Rechazada':
                                    $order->update_status('failed');
                                    break;
                                // Agregar casos adicionales si es necesario...
                                case 'Pendiente':
                                    $order->update_status('pending');
                                    break;
                                case 'Fallida':
                                    $order->update_status('failed');
                                    break;
                                case 'Reversada':
                                    $order->update_status('refunded');
                                    break;
                                case 'Retenida':
                                    $order->update_status('on-hold');
                                    break;
                                case 'Iniciada':
                                    $order->update_status('pending');
                                    break;
                                case 'Caducada':
                                    $order->update_status('cancelled');
                                    break;
                                case 'Abandonada':
                                    $order->update_status('cancelled');
                                    break;
                                case 'Cancelada':
                                    $order->update_status('cancelled');
                                    break;
                                case 'Error':
                                    $order->update_status('failed');
                                    break;
                            }

                            $response_data = [
                                "status" => ($estado_actual === 'Aceptada') ? "success" : "error",
                                "message" => ($estado_actual === 'Aceptada') ? "Pago realizado correctamente" : "Pago rechazado",
                                "data" => [
                                    "estado" => $estado_actual,
                                    "ref_payco" => $ref_payco,
                                    "order_id" => $order->get_id(),
                                    "total" => $order->get_total(),
                                    "descripcion_productos" => $order->get_items(),
                                ],
                            ];

                            echo json_encode($response_data);
                            die();
                        } else {
                            // La orden no existe, crea una nueva orden
                            $order = wc_create_order(['customer_id' => get_current_user_id()]);
                            $order->set_transaction_id($idenficadorOrden);

                            // Acciones específicas para nueva orden
                            switch ($estado_actual) {
                                case 'Aceptada':
                                    $order->update_status('completed');
                                    $woocommerce->cart->empty_cart();
                                    break;
                                case 'Rechazada':
                                    $order->update_status('failed');
                                    break;
                                // Agregar casos adicionales si es necesario...
                                case 'Pendiente':
                                    $order->update_status('pending');
                                    break;
                                case 'Fallida':
                                    $order->update_status('failed');
                                    break;
                                case 'Reversada':
                                    $order->update_status('refunded');
                                    break;
                                case 'Retenida':
                                    $order->update_status('on-hold');
                                    break;
                                case 'Iniciada':
                                    $order->update_status('pending');
                                    break;
                                case 'Caducada':
                                    $order->update_status('cancelled');
                                    break;
                                case 'Abandonada':
                                    $order->update_status('cancelled');
                                    break;
                                case 'Cancelada':
                                    $order->update_status('cancelled');
                                    break;
                                case 'Error':
                                    $order->update_status('failed');
                                    break;
                            }

                            $response_data = [
                                "status" => ($estado_actual === 'Aceptada') ? "success" : "error",
                                "message" => ($estado_actual === 'Aceptada') ? "Pago realizado correctamente" : "Pago rechazado",
                                "data" => [
                                    "estado" => $estado_actual,
                                    "ref_payco" => $ref_payco,
                                    "order_id" => $order->get_id(),
                                    "total" => $order->get_total(),
                                    "descripcion_productos" => $order->get_items(),
                                ],
                            ];

                            echo json_encode($response_data);
                            die();
                        }
                    } else {
                        throw new Exception('Código de transacción no válido: ' . $x_cod_transaction_state);
                    }
                } else {
                    throw new Exception('No se pudo obtener el estado de la transacción.');
                }
            }
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            wp_die();
        }
    }

    function wc_create_account($dataUser)
    {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }
        $table = "wp_buyers";
        $email = $dataUser["email"];
        $nombre = $dataUser["nombre"];

        $sql = "SELECT * FROM $table WHERE email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            return json_encode(
                array(
                    'status' => '400',
                    'message' => 'El email ya está registrado'
                )
            );
        } else {
            $RamdomPassword = wp_generate_password(12, false);
            $password = password_hash($RamdomPassword, PASSWORD_DEFAULT);

            $data = array(
                "username" => $nombre,
                "email" => $email,
                "password" => $password,
                "created-at" => date("Y-m-d H:i:s"),
                "updated-at" => date("Y-m-d H:i:s")
            );


            $sql = "INSERT INTO $table (`code_google`, `username`, `email`, `password`, `created-at`, `updated-at`) 
            VALUES ('', '$nombre', '$email', '$password', NOW(), NOW())";

            $result = $conn->query($sql);

            $dataUserInfo = array(
                "id_buyer" => $conn->insert_id,
                "name" => $nombre,
                "email" => $email,
                "address" => $dataUser["direccion"],
                "last_name" => $dataUser["apellido"],
                "phone" => $dataUser["telefono"],
                "created-at" => date("Y-m-d H:i:s"),
                "updated-at" => date("Y-m-d H:i:s")
            );


            $this->InserDataUserInfo($dataUserInfo);


            if ($result) {
                $this->sendEmail($email, $nombre, $RamdomPassword);
            }
        }
    }

    function sendEmail($email, $nombre, $RamdomPassword)
    {
        $mail = new DeliriosPHPMailer(true);
        try {
            $host = "smtp.titan.email";
            $userName = "info@delirios.co";
            $password = "rS3c+TDtf_~2DG";

            $mail = new DeliriosPHPMailer(true);
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = $host;
            $mail->Port = 465;
            $mail->SMTPAuth = true;
            $mail->Username = $userName;
            $mail->Password = $password;
            $mail->SMTPSecure = 'ssl';
            $mail->setFrom('info@delirios.co', 'Delirios');
            $mail->addAddress($email, $nombre);
            $mail->isHTML(true);
            $mail->Subject = 'Bienvenido a Delirios';
            ob_start();
            include get_template_directory() . '/includes/bodyMails/usermail.php';
            $body = ob_get_clean();
            $mail->Body = $body;
            $mail->send();
            return json_encode(
                array(
                    'status' => '200',
                    'message' => 'Usuario registrado correctamente'
                )
            );
        } catch (DeliriosException $e) {

            return json_encode(
                array(
                    'status' => '400',
                    'message' => 'Error al enviar el correo'
                )
            );
        }
    }

    function ConectBuyerAndOrder($email, $idOrder)
    {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        $table = "wp_buyers";

        $sql = "SELECT * FROM $table WHERE email = ?";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Error al preparar la consulta: " . $conn->error);
        }

        $stmt->bind_param("s", $email);

        if (!$stmt->execute()) {
            die("Error al ejecutar la consulta: " . $stmt->error);
        }

        $resultado = $stmt->get_result();

        $id = null;

        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                $id = $fila["id"];
            }
        } else {
            die("No se encontraron registros para el correo electrónico: " . $email);
        }

        $stmt->close();
        $conn->close();


        $data = array(
            "id_buyer" => $id,
            "id_order" => $idOrder,
            "created-at" => date("Y-m-d H:i:s"),
            "updated-at" => date("Y-m-d H:i:s")
        );

        $format = array(
            "%d",
            "%d",
            "%s",
            "%s"
        );

        $table = "wp_buyers_orders";
        global $wpdb;


        $sql = "SELECT * FROM $table WHERE id_buyer = $id AND id_order = $idOrder";
        $result = $wpdb->get_results($sql);

        if (count($result) > 0) {
            return;
        } else {
            $wpdb->insert($table, $data, $format);
        }
    }

    function InserDataUserInfo($dataUserInfo)
    {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        $nombre = $dataUserInfo["name"];
        $email = $dataUserInfo["email"];
        $apellido = $dataUserInfo["last_name"];
        $telefono = $dataUserInfo["phone"];
        $direccion = $dataUserInfo["address"];
        $id_buyer = $dataUserInfo["id_buyer"];


        $table = "info_buyer";

        $sql = "INSERT INTO $table (`id_user`, `email`, `name`, `last_name`, `phone`, `address`, `created-at`, `updated-at`) 
        VALUES ('$id_buyer', '$email' ,'$nombre', '$apellido', '$telefono', '$direccion', NOW(), NOW())";


        $result = $conn->query($sql);


        echo $conn->error;
    }

    function recoverPassword()
    {
        $email = $_POST["email"];
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        $tabla = "recovery_password";

        //verifica si el usuario actualmente tiene un token en 0 y si es asi envia error y no deja enviar otro correo
        $sql = "SELECT * FROM $tabla WHERE id_user = (SELECT id FROM wp_buyers WHERE email = '$email') AND status = 0";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            http_response_code(400);
            echo json_encode(
                array(
                    'status' => '400',
                    'message' => 'Ya se ha enviado un correo para recuperar la contraseña'
                )
            );
            die();
        }

        if (empty($email)) {
            http_response_code(400);
            echo json_encode(
                array(
                    'status' => '400',
                    'message' => 'El campo email es obligatorio'
                )
            );
            die();
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            http_response_code(400);
            echo json_encode(
                array(
                    'status' => '400',
                    'message' => 'El email no es valido'
                )
            );
            die();
        }

        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }
        $table = "wp_buyers";

        $sql = "SELECT * FROM $table WHERE email = '$email'";

        $result = $conn->query($sql);

        if ($result->num_rows == 0) {
            http_response_code(400);
            echo json_encode(
                array(
                    'status' => '400',
                    'message' => 'El email no está registrado'
                )
            );
            die();
        }

        //vamos a enviar un correo para recuperar la contraseña 

        $table = "wp_buyers";

        //take id user
        $sql = "SELECT * FROM $table WHERE email = '$email'";
        $result = $conn->query($sql);

        $id = null;

        if ($result->num_rows > 0) {
            while ($fila = $result->fetch_assoc()) {
                $id = $fila["id"];
            }
        } else {
            die("No se encontraron registros para el correo electrónico: " . $email);
        }

        $table = "recovery_password";


        $token = bin2hex(random_bytes(22));
        $sql = "INSERT INTO $table (`id_user`, `token`, `created_at`)
        VALUES ('$id', '$token', NOW())";

        $result = $conn->query($sql);

        echo $conn->error;

        $this->EmailResetPassword($email, $token);

        echo json_encode(
            array(
                'status' => '200',
                'message' => 'Se ha enviado un correo para recuperar la contraseña'
            )
        );

        die();
    }

    function EmailResetPassword($email, $token)
    {
        $mail = new DeliriosPHPMailer(true);
        try {
            $host = "smtp.titan.email";
            $userName = "info@delirios.co";
            $password = "rS3c+TDtf_~2DG";

            $mail = new DeliriosPHPMailer(true);
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = $host;
            $mail->Port = 465;
            $mail->SMTPAuth = true;
            $mail->Username = $userName;
            $mail->Password = $password;
            $mail->SMTPSecure = 'ssl';
            $mail->setFrom('info@delirios.co', 'Delirios');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Recuperar contraseña';
            ob_start();
            include get_template_directory() . '/includes/bodyMails/recoverPassword.php';
            $body = ob_get_clean();
            $mail->Body = $body;
            $mail->send();
            return json_encode(
                array(
                    'status' => '200',
                    'message' => 'Usuario registrado correctamente'
                )
            );
        } catch (DeliriosException $e) {

            return json_encode(
                array(
                    'status' => '400',
                    'message' => 'Error al enviar el correo'
                )
            );
        }
    }

    function ChangePasswordProfile()
    {
        $CurrentPassword = $_POST["currentPassword"];
        $NewPassword = $_POST["newPassword"];
        $ConfirmPassword = $_POST["confirmPassword"];
        $idUser = $_POST["idUser"];

        if (empty($CurrentPassword) || empty($NewPassword) || empty($ConfirmPassword)) {
            http_response_code(400);
            echo json_encode(
                array(
                    'status' => '400',
                    'message' => 'Todos los campos son obligatorios'
                )
            );
            die();
        }

        if ($NewPassword != $ConfirmPassword) {
            http_response_code(400);
            echo json_encode(
                array(
                    'status' => '400',
                    'message' => 'Las contraseñas no coinciden'
                )
            );
            die();
        }

        if (strlen($NewPassword) < 8) {
            http_response_code(400);
            echo json_encode(
                array(
                    'status' => '400',
                    'message' => 'La contraseña debe tener minimo 8 caracteres'
                )
            );
            die();
        }


        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        $table = "wp_buyers";

        $sql = "SELECT * FROM $table WHERE id = $idUser";

        $result = $conn->query($sql);

        if ($result->num_rows == 0) {
            http_response_code(400);
            echo json_encode(
                array(
                    'status' => '400',
                    'message' => 'El usuario no existe'
                )
            );
            die();
        }

        $user = $result->fetch_assoc();

        if (!password_verify($CurrentPassword, $user["password"])) {
            http_response_code(400);
            echo json_encode(
                array(
                    'status' => '400',
                    'message' => 'La contraseña actual es incorrecta'
                )
            );
            die();
        }

        $password_hash = password_hash($NewPassword, PASSWORD_DEFAULT);

        $sql = "UPDATE $table SET password = '$password_hash', `updated-at` = NOW() WHERE id = $idUser";

        $result = $conn->query($sql);

        if ($result) {
            http_response_code(200);
            echo json_encode(
                array(
                    'status' => '200',
                    'message' => 'Contraseña actualizada correctamente'
                )
            );
            die();
        } else {

            http_response_code(400);
            echo json_encode(
                array(
                    'status' => '400',
                    'message' => 'Error al actualizar la contraseña'
                )
            );
            die();
        }
    }

    function changeInfoProfile()
    {
        $response = array();
        ini_set('display_errors', 1);
        ini_set('log_errors', 0);
        error_reporting(E_ALL);

        $emailField = $_POST["emailField"];
        $nameField = $_POST["nameField"];
        $lastNameField = $_POST["lastNameField"];
        $adressField = $_POST["adressField"];
        $phoneField = $_POST["phoneField"];
        $idUser = $_POST["idUser"];

        if (empty($emailField) || empty($nameField) || empty($lastNameField) || empty($adressField) || empty($phoneField)) {
            http_response_code(400);
            echo json_encode(
                array(
                    'status' => '400',
                    'message' => 'Todos los campos son obligatorios'
                )
            );
            die();
        }

        if (!filter_var($emailField, FILTER_VALIDATE_EMAIL)) {
            http_response_code(400);
            echo json_encode(
                array(
                    'status' => '400',
                    'message' => 'El email no es valido'
                )
            );
            die();
        }

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        //revisa si el email ya esta registrado
        $table = "wp_buyers";

        $sql = "SELECT * FROM $table WHERE email = '$emailField' AND id != $idUser";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            http_response_code(400);
            echo json_encode(
                array(
                    'status' => '400',
                    'message' => 'El email ya está registrado'
                )
            );
            die();
        }

        $table = "info_buyer";

        //verifica si la informacion ya esta registrada 
        $sql = "SELECT * FROM $table WHERE id_user = $idUser";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $sql = "UPDATE $table SET email = '$emailField', name = '$nameField', last_name = '$lastNameField', phone = '$phoneField', address = '$adressField', `updated-at` = NOW() WHERE id_user = $idUser";

            $table_register = 'wp_buyers';
            $sql_register = "UPDATE $table_register SET email = '$emailField', `updated-at` = NOW() WHERE id = $idUser";
            $result_register = $conn->query($sql_register);
        } else {
            $sql = "INSERT INTO $table (`id_user`, `email`, `name`, `last_name`, `phone`, `address`, `created-at`, `updated-at`) 
            VALUES ('$idUser', '$emailField' ,'$nameField', '$lastNameField', '$phoneField', '$adressField', NOW(), NOW())";

            $table_register = 'wp_buyers';
            $sql_register = "UPDATE $table_register SET email = '$emailField', `updated-at` = NOW() WHERE id = $idUser";
            $result_register = $conn->query($sql_register);
        }

        $result = $conn->query($sql);

        if ($result) {
            http_response_code(200);
            echo json_encode(
                array(
                    'status' => '200',
                    'message' => 'Información actualizada correctamente'
                )
            );
            die();
        } else {
            http_response_code(400);
            echo json_encode(
                array(
                    'status' => '400',
                    'message' => 'Error al actualizar la información'
                )
            );
            die();
        }
    }

    function woocommerce_ajax_descargar_pdf()
    {

        $response = array();
        ini_set('display_errors', 1);
        ini_set('log_errors', 0);
        error_reporting(E_ALL);

        if (empty($_POST["id"]) || empty($_POST["Informacion_cliente_mas_productos"]) || empty($_POST["ProductosCliente"])) {
            echo json_encode(
                array(
                    "status" => "error",
                    "message" => "Todos los campos son obligatorios"
                )
            );
            die();
        }

        $Informacion_cliente_mas_productos = $_POST["Informacion_cliente_mas_productos"];
        $nombre_cliente = $Informacion_cliente_mas_productos[0] . " " . $Informacion_cliente_mas_productos[1];
        $direccion_cliente = $Informacion_cliente_mas_productos[2];
        $lugar = $Informacion_cliente_mas_productos[3];
        $PostalCode = $Informacion_cliente_mas_productos[4];
        $telefono_cliente = $Informacion_cliente_mas_productos[5];
        $email_cliente = isset($Informacion_cliente_mas_productos[6]) ? $Informacion_cliente_mas_productos[6] : "No tiene";
        $comentario = $Informacion_cliente_mas_productos[7];
        $valor_total = $Informacion_cliente_mas_productos[8];
        $valor_envio = $Informacion_cliente_mas_productos[9];
        $total_pagado = 0;

        foreach ($_POST["ProductosCliente"] as $product) {
            $total_pagado += $product["cantidad"] * $product["precio"];
        }



        $productsHtml = "";
        foreach ($_POST["ProductosCliente"] as $product) {
            $productsHtml .= "<tr>
            <td>" . htmlspecialchars($product["nombre"]) . "</td>
            <td style='text-align: center;'>" . htmlspecialchars($product["cantidad"]) . "</td>
            <td style='text-align: right;'>$" . number_format(htmlspecialchars($product["precio"]), 2, ',', '.') . "</td>
            <td style='text-align: right;'>$" . number_format(htmlspecialchars($product["cantidad"] * $product["precio"]), 2, ',', '.') . "</td>
            </tr>";
        }

        $datos = [
            '{{nombre_cliente}}' => $nombre_cliente,
            '{{direccion_cliente}}' => $direccion_cliente,
            '{{lugar}}' => $lugar,
            '{{PostalCode}}' => $PostalCode,
            '{{telefono_cliente}}' => $telefono_cliente,
            '{{email_cliente}}' => $email_cliente,
            '{{comentario}}' => $comentario,
            '{{valor_total}}' => number_format($valor_total, 2, ',', '.'),
            '{{valor_envio}}' => number_format($valor_envio, 2, ',', '.'),
            '{{total_pagado}}' => number_format($total_pagado, 2, ',', '.'),
            '{{id_order}}' => $_POST["id"],
            '{{fecha}}' => date("Y-m-d"),
            '{{site_url}}' => get_site_url(),
            '{{products}}' => $productsHtml
        ];

        $html = file_get_contents(get_template_directory() . '/includes/html_pdf_template/template.php');
        if (!$html) {
            echo json_encode(array("status" => "error", "message" => "Error al cargar la plantilla"));
            die();
        }

        foreach ($datos as $key => $value) {
            $html = str_replace($key, $value, $html);
        }

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $pdfContent = $dompdf->output();
        $pdfBase64 = base64_encode($pdfContent);

        if (!$pdfBase64) {
            echo json_encode(array("status" => "error", "message" => "Error al generar el PDF"));
            die();
        }

        echo json_encode(array("status" => "success", "pdf" => $pdfBase64));
        die();
    }

    // configuracion filtro
    private function _loadConfiguration()
    {
        remove_all_filters('posts_orderby'); // ADDED
        $categories = isset($_POST["categories"]) ? $_POST["categories"] : false;
        $tags = isset($_POST["tags"]) ? $_POST["tags"] : false;
        $price = isset($_POST["price"]) ? $_POST["price"] : false;
        $paged = isset($_POST["paged"]) && is_numeric($_POST["paged"]) ? $_POST["paged"] : false;
        $metaQuery = array();


        if ($price) {
            $metaQuery = array(
                "relation" => "AND",
                array(
                    'key' => '_price',
                    'value' => [$price[0], $price[1]],
                    "type" => "NUMERIC",
                    'compare' => 'BETWEEN',
                ),
            );
        }
        $this->prodBaseQuery["meta_query"] = $metaQuery;

        if ($paged) {
            $this->prodBaseQuery["paged"] = $paged;
        }

        if (isset($_POST["order"]) && isset($_POST["orderby"])) {
            $order = $_POST["order"];
            $orderby = $_POST["orderby"];
            if (($order === "asc" || $order === "desc")) {
                $this->prodBaseQuery["order"] = $order;
                if ($orderby === "_price") {
                    $this->prodBaseQuery["orderby"] = "meta_value_num";
                    $this->prodBaseQuery["meta_key"] = $orderby;
                } else if ($orderby === "publish_date") {
                    $this->prodBaseQuery["orderby"] = "publish_date";
                }
            }
        }

        $taxQuery = array();
        if ($categories) {
            $taxQuery[] = array(
                "taxonomy" => "product_cat",
                "terms" => $categories
            );
        }
        if ($tags) {
            $taxQuery[] = array(
                "taxonomy" => "product_tag",
                "terms" => $tags
            );
        }

        if (count($taxQuery) > 0) {
            $this->prodBaseQuery["tax_query"] = $taxQuery;
        }
    }

    public function shop_wrapper()
    {
        $this->_loadConfiguration();

        $query = new WP_Query($this->prodBaseQuery);
        ob_start();

        sc_render_shop_wrapper($query);

        $html = ob_get_clean();

        json(
            array(
                "error" => false,
                "html" => $html
            )
        );

        wp_die();
    }

    public function shop_wrapper_paginator()
    {
        $this->_loadConfiguration();

        $query = new WP_Query($this->prodBaseQuery);

        ob_start();

        foreach ($query->posts as $post) {
            echo "<div class='col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3'>";
            sc_render_product_single($post);
            echo "</div>";
        }

        $html = ob_get_clean();

        json(
            array(
                "error" => false,
                "html" => $html
            )
        );

        wp_die();
    }

}



new SyEAjaxRequest();
