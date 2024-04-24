<?php

$items = WC()->cart->get_cart();
    $total_items = count($items);
    $item_counter = 0;

    foreach ($items as $item => $values) {
        $item_counter++; ?>
         <pre style="height:400px">
      <?php print_r($values) ?>
      </pre>
      <?php
        productCardSmall($values, false);

    }

?>