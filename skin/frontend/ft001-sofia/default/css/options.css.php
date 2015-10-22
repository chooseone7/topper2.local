<?php
define('MAGENTO_ROOT', (dirname(__FILE__).'../../../../../../'));
$mageFilename = MAGENTO_ROOT . '/app/Mage.php';
require_once $mageFilename;

umask(0);
Mage::app();

$config = Mage::getStoreConfig('sofiadesign');
$color_helper = Mage::helper('sofiaadmin/color');

header("Content-type: text/css; charset: UTF-8");
?>

<?php if ( $config['font_setting']['enable_font'] ) : ?>
.subscribe-form label,
#shopping-cart-totals-table strong,
.add-review h3.title,
h1,h2,h3,h4,h5,h6,
.page-title h1,.page-title h2,
.block .block-title strong,
#mainNav>li>a {font-family:"<?php echo $config['font_setting']['font']; ?>"}
<?php endif; ?>

<?php if ( $config['color_setting']['text_color'] ) : ?>
body { color:<?php echo $config['color_setting']['text_color']; ?>; }
<?php endif; ?>

<?php if ( $config['color_setting']['link_color'] ) : ?>
a { color:<?php echo $config['color_setting']['link_color']; ?>; }
<?php endif; ?>

<?php if ( $config['color_setting']['link_hover_color'] ) : ?>
a:hover { color:<?php echo $config['color_setting']['link_hover_color']; ?>; }
<?php endif; ?>

<?php if ( $config['color_setting']['title_color'] ) : ?>
h3.title,
h1,h2,h3,h4,h5,h6,
.page-title h1,.page-title h2,
.block .block-title strong { color:<?php echo $config['color_setting']['title_color']; ?>; }
<?php endif; ?>

<?php if ( $config['color_setting']['button_text_color'] ) : ?>
button.button span span { color:<?php echo $config['color_setting']['button_text_color']; ?>; }
<?php endif; ?>

<?php if ( $config['color_setting']['button_bkg_color'] ) : ?>
.link-cart,
button.button span,
.product-carousel .nav-wrapper li a,
#toTop { background-color:<?php echo $config['color_setting']['button_bkg_color']; ?>; }
<?php endif; ?>

<?php if ( $config['color_setting']['button_text_hover_color'] ) : ?>
button.button:hover span span { color:<?php echo $config['color_setting']['button_text_hover_color']; ?>; }
<?php endif; ?>

<?php if ( $config['color_setting']['button_bkg_hover_color'] ) : ?>
.link-cart:hover,
button.button:hover span,
.product-carousel .nav-wrapper li a:hover { background-color:<?php echo $config['color_setting']['button_bkg_hover_color']; ?>; }
<?php endif; ?>


<?php if ( $config['color_setting']['button2_text_color'] ) : ?>
.block-cart .actions button.button span,
.multiple-checkout .title-buttons button.button span,
.cart-table .btn-empty span,
.cart-table .btn-continue span,
.cart-table .btn-update span,
button.btn-checkout span span,
.product-shop-info .btn-cart span span,
.the-slideshow .direction-nav a,
.subscribe-form .button span,
.form-search button.button span span, .block-mini-cart .icon-cart { color:<?php echo $config['color_setting']['button2_text_color']; ?>; }
<?php endif; ?>

<?php if ( $config['color_setting']['button2_bkg_color'] ) : ?>
.block-cart .actions button.button span,
.multiple-checkout .title-buttons button.button span,
.cart-table .btn-empty span,
.cart-table .btn-continue span,
.cart-table .btn-update span,
button.btn-checkout span span,
.product-shop-info .btn-cart span span,
.the-slideshow .direction-nav a,
.subscribe-form .button span,
.form-search button.button span span, .block-mini-cart .icon-cart { background-color:<?php echo $config['color_setting']['button2_bkg_color']; ?>; }
<?php endif; ?>

<?php if ( $config['color_setting']['button2_text_hover_color'] ) : ?>
.multiple-checkout .title-buttons button.button:hover span,
.cart-table .btn-empty:hover span,
.cart-table .btn-continue:hover span,
.cart-table .btn-update:hover span,
button.btn-checkout:hover span span,
.product-shop-info .btn-cart:hover span span,
.the-slideshow .direction-nav a:hover,
.subscribe-form .button:hover span,
.form-search button.button:hover span span, .block-mini-cart .icon-cart:hover { color:<?php echo $config['color_setting']['button2_text_hover_color']; ?>; }
<?php endif; ?>

<?php if ( $config['color_setting']['button2_bkg_hover_color'] ) : ?>
.multiple-checkout .title-buttons button.button:hover span,
.cart-table .btn-empty:hover span,
.cart-table .btn-continue:hover span,
.cart-table .btn-update:hover span,
button.btn-checkout:hover span span,
.product-shop-info .btn-cart:hover span span,
.the-slideshow .direction-nav a:hover,
.subscribe-form .button:hover span,
.form-search button.button:hover span span, .block-mini-cart .icon-cart:hover { background-color:<?php echo $config['color_setting']['button2_bkg_hover_color']; ?>; }
<?php endif; ?>

<?php if ( $config['header']['text_header_color'] ) : ?>
.header-container { color: <?php echo $config['header']['text_header_color']; ?>; }
<?php endif; ?>

<?php if ( $config['header']['link_header_color'] ) : ?>
.header-container a { color: <?php echo $config['header']['link_header_color']; ?>; }
<?php endif; ?>

<?php if ( $config['header']['link_header_hover_color'] ) : ?>
.header-container a:hover { color: <?php echo $config['header']['link_header_hover_color']; ?>; }
<?php endif; ?>

<?php if ( $config['header']['header_bgk_color'] ) : ?>
.header-container { background-color: <?php echo $config['header']['header_bgk_color']; ?>; }
<?php endif; ?>

<?php if ( $config['quick_access_bar']['text_access_color'] ) : ?>
.quick-access { color: <?php echo $config['quick_access_bar']['text_access_color']; ?>; }
<?php endif; ?>

<?php if ( $config['quick_access_bar']['link_access_color'] ) : ?>
.quick-access a { color: <?php echo $config['quick_access_bar']['link_access_color']; ?>; }
.quick-access .links a:before { border-left-color: <?php echo $config['quick_access_bar']['link_access_color']; ?>; }
.dropdown .label:after { border-top-color: <?php echo $config['quick_access_bar']['link_access_color']; ?>; }
<?php endif; ?>

<?php if ( $config['quick_access_bar']['link_access_hover_color'] ) : ?>
.quick-access a:hover { color: <?php echo $config['quick_access_bar']['link_access_hover_color']; ?>; }
.quick-access .links a:hover:before { border-left-color: <?php echo $config['quick_access_bar']['link_access_hover_color']; ?>; }
.dropdown:hover .label:after { border-top-color: <?php echo $config['quick_access_bar']['link_access_hover_color']; ?>; }
<?php endif; ?>

<?php if ( $config['quick_access_bar']['quick_access_bk_color'] ) : ?>
.quick-access { background-color: <?php echo $config['quick_access_bar']['quick_access_bk_color']; ?>; }
<?php endif; ?>



<?php if ( $config['color_setting']['theme_color'] ) : ?>
.link-cart:hover,
.opc .active .step-title,
.product-label,
#mobile-nav>li.active>a,
#mobile-nav>li.over>a,
#mobile-nav>li>a:hover {
    background-color: <?php echo $config['color_setting']['theme_color']; ?>;
}

.price-box .price,
.block-mini-cart .amount,
.dropdown:hover .label,
.subtitle,.sub-title,
.fieldset .legend,
.location .address span,
.multiple-checkout .place-order .grand-total .price,
.multiple-checkout .box h2,
.multiple-checkout h3,.multiple-checkout h4,
.checkout-progress li.active,
.opc .active .step-title .number,
.opc .allow .step-title h2,
.opc .allow .step-title .number,
.block-progress dt a,
.product-view .product-shop .price-box .price,
.tier-prices .benefit,
.block-cart .subtotal .price,
.block-layered-nav dt,
.block-account .block-content li a:hover,
.block-account .block-content li.current,
#mobile-nav ul li.active>a,
#mobile-nav ul li.over>a,
#mobile-nav ul li>a:hover {
    color: <?php echo $config['color_setting']['theme_color']; ?>;
}

#mainNav>li:hover>a>span,
#mainNav>li.over>a>span,
#mainNav>li.active>a>span,
.block:hover .block-title strong {
    border-color: <?php echo $config['color_setting']['theme_color']; ?>;
}

<?php endif; ?>

<?php if ( $config['navigation']['text_nav_color'] ) : ?>
.nav-container .nav-top-title,
#mobile-nav li>a,
#mainNav>li>a { color: <?php echo $config['navigation']['text_nav_color']; ?>; }
.nav-container .nav-top-title div.icon span { background-color: <?php echo $config['navigation']['text_nav_color']; ?>; }
<?php endif; ?>

<?php if ( $config['navigation']['text_sub_nav_color'] ) : ?>
#mainNav ul li a { color: <?php echo $config['navigation']['text_sub_nav_color']; ?>; }
<?php endif; ?>

<?php if ( $config['navigation']['border_nav_color'] ) : ?>
.navigation { border-color: <?php echo $config['navigation']['border_nav_color']; ?>; }
<?php endif; ?>



<?php if ( $config['subfooter']['subfooter_bk_color'] ) : ?>
.before-spotlight { background-color: <?php echo $config['subfooter']['subfooter_bk_color']; ?>; }
<?php endif; ?>

<?php if ( $config['subfooter']['subfooter_text_color'] ) : ?>
.social-block h4,
.before-spotlight { color: <?php echo $config['subfooter']['subfooter_text_color']; ?>; }
<?php endif; ?>

<?php if ( $config['subfooter']['subfooter_link_color'] ) : ?>
.before-spotlight a { color: <?php echo $config['subfooter']['subfooter_link_color']; ?>; }
<?php endif; ?>

<?php if ( $config['subfooter']['subfooter_link_hover_color'] ) : ?>
.before-spotlight a:hover { color: <?php echo $config['subfooter']['subfooter_link_hover_color']; ?>; }
<?php endif; ?>


<?php if ( $config['footer']['footer_bk_color'] ) : ?>
.spotlight, .footer-container { background-color: <?php echo $config['footer']['footer_bk_color']; ?>; }
<?php endif; ?>

<?php if ( $config['footer']['footer_text_color'] ) : ?>
.spotlight,.footer-container{ color: <?php echo $config['footer']['footer_text_color']; ?>; }
<?php endif; ?>

<?php if ( $config['footer']['footer_link_color'] ) : ?>
.spotlight a,.footer-container a { color: <?php echo $config['footer']['footer_link_color']; ?>; }
.sl-block li:after { background-color: <?php echo $config['footer']['footer_link_color']; ?>;}
<?php endif; ?>

<?php if ( $config['footer']['footer_link_hover_color'] ) : ?>
.spotlight a:hover, .footer-container a:hover { color: <?php echo $config['footer']['footer_link_hover_color']; ?>; }
.sl-block li:hover:after { background-color: <?php echo $config['footer']['footer_link_hover_color']; ?>;}
<?php endif; ?>
