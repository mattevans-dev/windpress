<?php
  $padding = windpress_get_block_padding();
  $margin = windpress_get_block_margin();
  $block_attr = get_block_wrapper_attributes(["class" => "full-width group not-prose py-block-sm $padding $margin"]);
?>

<section id="<?= esc_attr($block['id']); ?>" <?php echo $block_attr; ?>>
  <div class="container">
    <h1 class="text-lg font-bold text-red-500">Hello World!</h1>
    <p>I am an example block. Feel free to delete me.</p>
  </div>
</section>