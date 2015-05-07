<?php get_header(); ?>

  <?php the_content();?>

  <?php 
    require_once __DIR__ . '/vendor/autoload.php';
    use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;
    // create instance
    $cssToInlineStyles = new CssToInlineStyles();
    $html = file_get_contents(__DIR__ . '/example.html');
    $css = file_get_contents(__DIR__ . '/example.css');
    $cssToInlineStyles->setHTML($html);
    $cssToInlineStyles->setCSS($css);
    // output
    echo $cssToInlineStyles->convert();

    ?>
  
<?php get_footer(); ?>
