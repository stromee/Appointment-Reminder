<?php
// group/winter theme

//background image should be named background.png and be 600 x 960

//type measurements should be from the baseline (not the top of the letter)

define('REVERSE_LOGO',false); // true uses logoname_rev.png for reversed out version

//colors
define('COLOR_TOP_TITLE','0,39,159'); // top box title color R, G, B
define('COLOR_TOP_TEXT','1,2,3'); // top box text color R, G, B

define('COLOR_TITLE','255,255,255'); // title color R, G, B
define('COLOR_TEXT','255,255,255'); // text color R, G, B

define('COLOR_COPYRIGHT','255,255,255'); // text color R, G, B
define('COLOR_CANCEL','255,255,255'); // text color R, G, B

define('COLOR_LIST','255,255,255'); // text color R, G, B

define('COLOR_CHECKBOX','128,128,128'); // checkbox border color R, G, B

//nexstar logo position
define('NEXSTAR_LOGO_X',33);
define('NEXSTAR_LOGO_Y',900);

//where to start text blocks
define('LEFT_MARGIN',56);
define('TOP_MARGIN',267); //for text, not top box

//top white box vertical position
define('TOP_BOX_X',30);
define('TOP_BOX_Y',16);

//photo position and size - x,y,w,h
define('PHOTO_BOX','405,200,170,180');

//copyright and credit card items
define('COPYRIGHT_X',361);
define('COPYRIGHT_Y',951); //baseline

define('CREDIT_CARDS_X',123);
define('CREDIT_CARDS_Y',123);

//logo, more info, website, cancel message
define('LOGO_BLOCK_Y',670);
define('LOGO_BLOCK_CENTER',450); //items are centered around this point

//text blocks
define('BENEFITS_X',60);
define('BENEFITS_Y',240);
define('BENEFITS_WIDTH',330);

define('UPSELL_Y',440);
define('UPSELL_LIST_X',85);
define('UPSELL_LIST_WIDTH',205); //determine wrap point - for 2 col lists, this is the same for both

//if 2 cols, both are required
//define('UPSELL_LIST_COLS',2);
define('UPSELL_LIST_GUTTER',24);

define('SERVICES_Y',630);
define('SERVICES_LIST_X',85);
define('SERVICES_LIST_WIDTH',260); //determine wrap point