<?php
/**
* PLUGIN MAIN CLASS
*/

class VCExtendAddonClass
{
	
	function __construct() {
        // We safely integrate with VC with this hook
        add_action( 'init', array( $this, 'integrateWithVC' ) );
        // Use this when creating a shortcode addon
        add_shortcode( 'bartag', array( $this, 'renderMyBartag' ) );
        // loading front end scripts and css
        add_action('wp_enqueue_scripts', array($this, 'load_front_end_styles_and_scripts'));
        add_action('admin_enqueue_scripts', array($this, 'admin_style_and_scripts'));
    }

  function load_front_end_styles_and_scripts(){
      wp_enqueue_style( 'ihover-css',plugins_url( 'css/animate.css', __FILE__ ));
      wp_enqueue_style( 'pr-animate-css',plugins_url( 'css/ihover.min.css', __FILE__ ));
      wp_enqueue_style( 'ultimate-hover-css',plugins_url( 'css/hover-effects.css', __FILE__ ));
      wp_enqueue_script( 'wawo-js',plugins_url( 'js/wow.min.js', __FILE__ ), array('jquery'));
  		wp_enqueue_script( 'front-js',plugins_url( 'js/admin.js', __FILE__ ), array('jquery'));
  	}

    function admin_style_and_scripts(){
      wp_enqueue_script( 'admin-js',plugins_url( 'js/hover-script.js', __FILE__ ), array('jquery') , true , 1.0);
      wp_enqueue_style( 'admin-css',plugins_url( 'css/admin.css', __FILE__ ));
    }


   public function integrateWithVC() {

        /*
        Add your Visual Composer logic here.
        Lets call vc_map function to "register" our custom shortcode within Visual Composer interface.

        More info: http://kb.wpbakery.com/index.php?title=Vc_map
        */
        vc_map( array(
            "name" => __("Image Hover Effects", 'pr-hover-effect'),
            "description" => __("Great Image Effect", 'pr-hover-effect'),
            "base" => "bartag",
            "class" => "",
            "controls" => "full",
            "icon" => plugins_url('images/icon.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "pr-hover-effect_my_class"
            "category" => __('Content', 'pr-hover-effect'),
            "params" => array(
                array(
                "type" => "attach_images",
                "heading" => __("Select Image", "pr-hover-effect"),
                "param_name" => "hover_img",
                "value" => "",
                "description" => __("Select images from media library.", "pr-hover-effect"),
                "group"       =>  'Media',
              ),
              array(
                "type" => "textfield",
                "holder" => "",
                "class" => "pr-hover-effect",
                "heading" => __("Thumbnail Title", 'pr-hover-effect'),
                "param_name" => "thumbtitle",
                "value" => __("Thumbnail title", 'pr-hover-effect'),
                "description" => __("Enter title for each thumbnail here.", 'pr-hover-effect'),
                "group"       =>  'Media',
              ),
              array(
                "type" => "textfield",
                "holder" => "",
                "class" => "pr-hover-effect",
                "heading" => __("Thumbnail Description", 'pr-hover-effect'),
                "param_name" => "thumbdesc",
                "value" => __("Thumbnail description", 'pr-hover-effect'),
                "description" => __("Enter description for each thumbnail here.15 words only", 'pr-hover-effect'),
                "group"       =>  'Media',
              ),

              // select image style
              array(
                  "type" => "dropdown",
                  "holder" => "",
                  "class" => "pr-hover-effect",
                  "heading" => __("Thumbnail shape", "pr-hover-effect"),
                  "param_name" => "shape",
                  "value" => array(__("square", "pr-hover-effect") => 'square', __("circle", "pr-hover-effect") => 'circle' , __("ihover square", "pr-hover-effect") => 'isquare'),
                  "description" => __('Choose image style.', 'pr-hover-effect'),
                  "group"       =>  'Image Layout',
              ),
              // effects sec
              array(
                  "type" => "dropdown",
                  "heading" => __("Effect", "pr-hover-effect"),
                  "param_name" => "square_effect",
                  "description" => __('select hover effects', 'pr-hover-effect'),
                  "value" => array(__("port-1 effect-1", "pr-hover-effect") => 'port-1 effect-1', __("port-1 effect-2", "pr-hover-effect") => 'port-1 effect-2', __("port-1 effect-3", "pr-hover-effect") => 'port-1 effect-3'),
                  "dependency" => Array('element' => "shape", 'value' => array('square')),
                  "group"       =>  'Image Layout',
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "pr-hover-effect",
                "heading" => __("Effect", "pr-hover-effect"),
                "param_name" => "effect",
                "value" => array(__("effect1", "pr-hover-effect") => "effect1", __("effect2", "pr-hover-effect") => "effect2", __("effect3", "pr-hover-effect") => "effect3", __("effect4", "pr-hover-effect") => "effect4", __("effect5", "pr-hover-effect") => "effect5"),
                "description" => __("select hover effects", "pr-hover-effect"),
                "dependency" => Array('element' => "shape", 'value' => array('circle')),
                "group"       =>  'Image Layout',
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "pr-hover-effect",
                "heading" => __("Effect", "pr-hover-effect"),
                "param_name" => "isquare_effect",
                "value" => array(__("effect1", "pr-hover-effect") => "effect1", __("effect2", "pr-hover-effect") => "effect2", __("effect3", "pr-hover-effect") => "effect3", __("effect4", "pr-hover-effect") => "effect4", __("effect5", "pr-hover-effect") => "effect5", __("effect6", "pr-hover-effect") => "effect6"),
                "description" => __("select hover effects", "pr-hover-effect"),
                "dependency" => Array('element' => "shape", 'value' => array('isquare')),
                "group"       =>  'Image Layout',
              ),
              array(
                "type" => "textfield",
                "holder" => "",
                "class" => "pr-hover-effect",
                "heading" => __("Image Width", 'pr-hover-effect'),
                "param_name" => "thumb_width",
                "description" => __("Enter Width For image in PX >>>> BUY PRO", 'pr-hover-effect'),
                "group"       =>  'Dimention',
              ),
              array(
                "type" => "textfield",
                "holder" => "",
                "class" => "pr-hover-effect",
                "heading" => __("Image Height", 'pr-hover-effect'),
                "param_name" => "thumb_height",
                "description" => __("Enter Height For image in PX  >>>> BUY PRO", 'pr-hover-effect'),
                "group"       =>  'Dimention',
                "dependency" => Array('element' => "shape", 'value' => array('square','isquare')),
              ),
            // effect directions
              array(
                  "type" => "dropdown",
                  "heading" => __("Animation direction", "pr-hover-effect"),
                  "param_name" => "direction1",
                  "description" => __('The animaion direction', 'pr-hover-effect'),
                  "value" => array(__("left_to_right", "pr-hover-effect") => 'left_to_right', __("right_to_left", "pr-hover-effect") => 'right_to_left', __("top_to_bottom", "pr-hover-effect") => 'top_to_bottom', __("bottom_to_top", "pr-hover-effect") => 'bottom_to_top'),
                  "dependency" => Array('element' => "effect", 'value' => array('effect1', 'effect2', 'effect3', 'effect4', 'effect5', 'effect7', 'effect8', 'effect9', 'effect10', 'effect11', 'effect12', 'effect13', 'effect14', 'effect15', 'effect16', 'effect17', 'effect18', 'effect19')),
                  "group"       =>  'Direction',
              ),
              array(
                  "type" => "dropdown",
                  "heading" => __("Animation direction", "pr-hover-effect"),
                  "param_name" => "direction2",
                  "description" => __('The animaion direction', 'pr-hover-effect'),
                  "value" => array(__("top_to_bottom", "pr-hover-effect") => 'top_to_bottom', __("bottom_to_top", "pr-hover-effect") => 'bottom_to_top'),
                  "dependency" => Array('element' => "effect", 'value' => array('effect20')),
                  "group"       =>  'Direction',
              ),
              array(
                  "type" => "dropdown",
                  "heading" => __("Animation direction", "pr-hover-effect"),
                  "param_name" => "direction3",
                  "description" => __('The animaion direction', 'pr-hover-effect'),
                  "value" => array(__("scale_up", "pr-hover-effect") => 'scale_up', __("scale_down", "pr-hover-effect") => 'scale_down'),
                  "dependency" => Array('element' => "effect", 'value' => array('effect6')),
                  "group"       =>  'Direction',
              ),
              // isquare direction 
              array(
                  "type" => "dropdown",
                  "heading" => __("Animation direction", "pr-hover-effect"),
                  "param_name" => "isquare_direction",
                  "description" => __('The animaion direction', 'pr-hover-effect'),
                  "value" => array(__("left_to_right", "pr-hover-effect") => 'left_to_right', __("right_to_left", "pr-hover-effect") => 'right_to_left', __("top_to_bottom", "pr-hover-effect") => 'top_to_bottom', __("bottom_to_top", "pr-hover-effect") => 'bottom_to_top'),
                  "dependency" => Array('element' => "isquare_effect", 'value' => array('effect3', 'effect5', 'effect9', 'effect10', 'effect11', 'effect12', 'effect13', 'effect14', 'effect15')),
                  "group"       =>  'Direction',
              ),
               array(
                  "type" => "dropdown",
                  "heading" => __("Animation direction", "pr-hover-effect"),
                  "param_name" => "isquare_direction1",
                  "description" => __('The animaion direction', 'pr-hover-effect'),
                  "value" => array(__("left_and_right", "pr-hover-effect") => 'left_and_right', __("right_to_left", "pr-hover-effect") => 'right_to_left', __("top_to_bottom", "pr-hover-effect") => 'top_to_bottom', __("bottom_to_top", "pr-hover-effect") => 'bottom_to_top'),
                  "dependency" => Array('element' => "isquare_effect", 'value' => array('effect1')),
                  "group"       =>  'Direction',
              ),
              array(
                  "type" => "dropdown",
                  "heading" => __("Animation direction", "pr-hover-effect"),
                  "param_name" => "isquare_direction2",
                  "description" => __('The animaion direction', 'pr-hover-effect'),
                  "value" => array(__("scale_up", "pr-hover-effect") => 'scale_up', __("scale_down", "pr-hover-effect") => 'scale_down'),
                  "dependency" => Array('element' => "isquare_effect", 'value' => array('effect8')),
                  "group"       =>  'Direction',
              ),
              array(
                  "type" => "dropdown",
                  "heading" => __("Animation direction", "pr-hover-effect"),
                  "param_name" => "isquare_direction3",
                  "description" => __('The animaion direction', 'pr-hover-effect'),
                  "value" => array(__("from_top_and_bottom", "pr-hover-effect") => 'from_top_and_bottom', __("from_left_and_right", "pr-hover-effect") => 'from_left_and_right', __("top_to_bottom", "pr-hover-effect") => 'top_to_bottom', __("bottom_to_top", "pr-hover-effect") => 'bottom_to_top'),
                  "dependency" => Array('element' => "isquare_effect", 'value' => array('effect6')),
                  "group"       =>  'Direction',
              ),
              array(
                "type" => "textfield",
                "holder" => "",
                "class" => "pr-hover-effect",
                "heading" => __("Image Link", 'pr-hover-effect'),
                "param_name" => "img_link",
                "value" => __("http://", 'pr-hover-effect'),
                "description" => __("Insert External Image Link Here", 'pr-hover-effect'),
                "group"       =>  'Media',
              ),
              array(
                "type" => "dropdown",
                "holder" => "",
                "class" => "pr-hover-effect",
                "heading" => __("Thumb Alignment", 'pr-hover-effect'),
                "param_name" => "img_align",
                "value" => array(__("right", "pr-hover-effect") => 'flot:right;', __("left", "pr-hover-effect") => 'flot:left;', __("middle", "pr-hover-effect") => 'margin:0 auto;'),
                "description" => __("Select thumbnail alignment by defualt is middle.", 'pr-hover-effect'),
                "group"       =>  'Media',
              ),

              // square button text
              array(
                  "type" => "textfield",
                  "heading" => __("Button Text", "pr-hover-effect"),
                  "param_name" => "button_text",
                  "description" => __('Read More Button Text By Default Read More', 'pr-hover-effect'),
                  "value" => 'Read More',
                  "dependency" => Array("element" => "shape","value" => array("square")),
                  "group"       =>  'Button',
              ),
              // on scroll animation sec
              array(
                  "type" => "dropdown",
                  "heading" => __("On Scroll Animation", "pr-hover-effect"),
                  "param_name" => "enable_scroll_animation",
                  "description" => __('The on scorll animaion direction >>>>> BUY PRO', 'pr-hover-effect'),
                  "value" => array(__("yes", "pr-hover-effect") => '', __("no", "pr-hover-effect") => ''),
                  "group"       =>  'Animation',
                  
              ),
              array(
                  "type" => "dropdown",
                  "heading" => __("Select Animation Effects", "pr-hover-effect"),
                  "param_name" => "scroll_effects",
                  "description" => __('The animaion effects  >>>>> BUY PRO', 'pr-hover-effect'),
                  "value" => array(__("bounce", "pr-hover-effect") => 'bounce'),
                  "dependency" => Array('element' => "enable_scroll_animation", 'value' => array('')),
                  "group"       =>  'Animation',
              ),
              array(
                  "type" => "dropdown",
                  "heading" => __("Animation Speed", "pr-hover-effect"),
                  "param_name" => "scroll_speed",
                  "description" => __('animation speed by default is 2s  >>>>> BUY PRO', 'pr-hover-effect'),
                  "value" => array(__("1", "pr-hover-effect") => '1'),
                  "dependency" => Array('element' => "enable_scroll_animation", 'value' => array('')),
                  "group"       =>  'Animation',
              ),
              // color section 
              array(
                "type" => "colorpicker",
                "class" => "hvr-thumb-title",
                "heading" => __("Thumb Title Color", "pr-hover-effect"),
                "param_name" => "thumb_heading",
                "value" => "#333333",
                "description" => __("Give it a nice paint! >>>> BUY PRO", "pr-hover-effect"),
                "group"       =>  'Color',
                //"dependency" => Array("element" => "modal_on","value" => array("button")),
              ),
              array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Thumb Description Color", "pr-hover-effect"),
                "param_name" => "thumb_des",
                "value" => "#FFFFFF",
                "description" => __("Give it a nice paint!  >>>> BUY PRO", "pr-hover-effect"),
                "group"       =>  'Color',
                //"dependency" => Array("element" => "modal_on","value" => array("button")),
              ),
              array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("On Hover Background Color", "pr-hover-effect"),
                "param_name" => "thumb_bg",
                "value" => "#D3A400",
                "description" => __("Give it a nice paint!  >>>> BUY PRO", "pr-hover-effect"),
                "group"       =>  'Color',
                //"dependency" => Array("element" => "shape","value" => array("circle"))
              ),
              array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Image Border Color", "pr-hover-effect"),
                "param_name" => "thumb_border",
                "value" => "#D3A400",
                "description" => __("Give it a nice paint!", "pr-hover-effect"),
                "dependency" => Array("element" => "shape","value" => array("square")),
                "group"       =>  'Color',
              ),
              array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Button Background Color", "pr-hover-effect"),
                "param_name" => "button_bg",
                "value" => "#D3A400",
                "description" => __("Give it a nice paint!", "pr-hover-effect"),
                "dependency" => Array("element" => "shape","value" => array("square")),
                "group"       =>  'Color',
              ),
              array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Button Text Color", "pr-hover-effect"),
                "param_name" => "button_text_clr",
                "value" => "#D3A400",
                "description" => __("Give it a nice paint!", "pr-hover-effect"),
                "dependency" => Array("element" => "shape","value" => array("square")),
                "group"       =>  'Color',
              ),
            )
        ) );
    }

	// THIS CALL BACK RENDERING SCHORTCODE ON FORNT END 
	
	function renderMyBartag($atts , $content = null){

   
    $foo = $color = $hover_img = $content = $image_style = $circle_img = $square_img = $effect = $direction1 = $direction2 = $direction3 = '';
		 extract( shortcode_atts( array(
      'hover_img' => '',
      'shape' => 'square',
      'thumb_width' => '',
      'thumb_height' => '',
      'effect' => 'effect1',
      'square_effect' => 'port-1 effect-1',
      'isquare_effect' => 'effect1',
      'isquare_direction' => 'left_to_right',
      'isquare_direction1' => 'left_and_right',
      'isquare_direction2' => 'scale_up',
      'isquare_direction3' => 'from_top_and_bottom',
      'direction1' => 'left_to_right',
      'direction2' => 'top_to_bottom',
      'direction3' => 'scale_up',
      'enable_scroll_animation' => 'yes',
      'scroll_effects' => '',
      'scroll_speed' => '2',
      'thumbtitle' => 'Title',
      'thumbdesc' => 'Discription Goes Here',
      'img_link' => '',
      'img_align' => '',
      'thumb_heading' => '',
      'thumb_des' => '',
      'thumb_bg' => '',
      'button_bg' => '',
      'button_text_clr' => '',
      'button_text' => 'Read More',
      'thumb_border' => '',

    ), $atts,'bartag' ) );

     $html = $square_btn_styling = $circle_bg = $on_scroll_animation = $img_alignment = $square_styling = $sqaure_align = $square_bg = $square_dir = $circle_dir = ''; 

    //echo $opacity_val;
    $content = wpb_js_remove_wpautop($content); // fix unclosed/unwanted paragraph tags in $content
    $get_img = wp_get_attachment_image_src( $hover_img , array(225, 225));

    // checking if image don't upload use placeholder
    if(isset($get_img) && $get_img != ''){
      $bg_img = $get_img[0];
    }else{
      $bg_img = plugins_url( 'images/placeholder.png', __FILE__ ) ;
    }

    // setting by default widht 
    if(isset($thumb_width) && $thumb_width != ''){
      $thumb_width = $thumb_width;
    }else{
      $thumb_width = '250px';
    }

    if ($effect == 'effect3' || $effect == 'effect4' || $effect == 'effect6' || $effect == 'effect7' || $effect == 'effect8' || $effect == 'effect9' || $effect == 'effect10' || $effect == 'effect11' || $effect == 'effect12' || $effect == 'effect14' || $effect == 'effect15' || $effect == 'effect16' || $effect == 'effect18' ) {
      $circle_bg .= 'background-color: '.$thumb_bg.';';
    }

    if ($enable_scroll_animation == 'yes') {
      $on_scroll_animation = $scroll_effects;
    }
    if($square_effect == 'port-1 effect-1' || $square_effect == 'port-1 effect-2' || $square_effect == 'port-1 effect-3'){
        $square_styling .= 'opacity: 0.9;';
        $square_styling .= 'background-color: '.$thumb_bg.';';
        $square_styling .= 'padding: 0!important;';
    }else{
      $square_styling .= 'background-color: '.$thumb_bg.';';
      $square_styling .= 'padding: 0!important;';
    }

    if ($thumb_border != '') {
      $sqaure_align .= 'border:4px solid '.$thumb_border.';';
    }
    if ($isquare_effect == 'effect1' || $isquare_effect == 'effect2' || $isquare_effect == 'effect3' || $isquare_effect == 'effect5' || $isquare_effect == 'effect8' || $isquare_effect == 'effect9' || $isquare_effect == 'effect10' || $isquare_effect == 'effect11' || $isquare_effect == 'effect14' || $isquare_effect == 'effect15') {
      $square_bg = 'background-color:'.$thumb_bg.';';
    }

    // circle direction settings
    if ($effect == 'effect6') {
      $circle_dir .= $direction3;
    }elseif($effect == 'effect20'){
      $circle_dir .= $direction2;
    }else{
      $circle_dir .= $direction1;
    }
   // isqaure direction settings
   if ($isquare_effect == 'effect3' || $isquare_effect == 'effect5' || $isquare_effect == 'effect9' || $isquare_effect == 'effect10' || $isquare_effect == 'effect11' || $isquare_effect == 'effect12' || $isquare_effect == 'effect13' || $isquare_effect == 'effect14' || $isquare_effect == 'effect15') {
     $square_dir .= $isquare_direction;
   }elseif($isquare_effect == 'effect1'){
     $square_dir .= $isquare_direction1;
   }elseif($isquare_effect == 'effect6'){
    $square_dir .= $isquare_direction3;
   }
    // defaultcsss
    $html .= '<style>
          #pr-square{
            width: 100%;
            max-width: 300px;
            float:none;
          }
          #pr-square img{
            width: 100%;
            max-width: 300px;
          }
          .text-desc a{
            text-decoration:none;
          }
          .ih-item  .img{
            height:100%;
          }
          .ih-item.square.effect4 a:hover .info {
            width: 100%!important;
          }
    </style>';
   

    if ($shape == 'circle') {
      $html .= '<div style="'.$img_align.';width:100%;max-width:'.$thumb_width.';height:'.$thumb_width.';" data-wow-duration="'.$scroll_speed.'s" class="ih-item circle '.$effect.' '.$circle_dir.' wow '.$on_scroll_animation.'">
                    <a href="'.$img_link.'">
                      <div class="spinner"></div>
                      <div class="img" style="width:100%;max-width:'.$thumb_width.';height:'.$thumb_width.';">
                <img src="'.$bg_img.'"></div>
                        <div class="info" style="'.$circle_bg.'" >
                          <div class="info-back">
                            <h3 style="color:'.$thumb_heading.';">'.$thumbtitle.'</h3>
                            <p style="color:'.$thumb_des.';">'.$thumbdesc.'</p>
                          </div>
                        </div>
                    </a>
                  </div>';
    } elseif($shape == 'square'){
      $html .='<div id="pr-square" style="'.$img_align.'width:100%;max-width:'.$thumb_width.';height:'.$thumb_height.'"><div data-wow-duration="'.$scroll_speed.'s" style="'.$sqaure_align.'" class="'.$square_effect.'  wow '.$on_scroll_animation.'">
                  <div class="image-box">
                      <img style="width:100%;max-width:'.$thumb_width.';height:'.$thumb_height.';" src="'.$bg_img.'" alt="Image-2">
                    </div>
                    <div class="text-desc" style="'.$square_styling.'">
                      <h3 style="color:'.$thumb_heading.';">'.$thumbtitle.'</h3>
                        <p style="color:'.$thumb_des.';">'.$thumbdesc.'</p>
                      <a href="'.$img_link.'" class="btn"  style="background-color:'.$button_bg.';border:none;color:'.$button_text_clr.'">'.$button_text.'</a>
                    </div>
                </div></div>';
    } elseif($shape == 'isquare'){
      $html .='<div style="'.$img_align.' width:100%;max-width:'.$thumb_width.';height:'.$thumb_height.'" data-wow-duration="'.$scroll_speed.'s" class="ih-item square '.$isquare_effect.' '.$square_dir.' wow '.$on_scroll_animation.'">
                <a href="'.$img_link.'">
                  <div class="img"><img src="'.$bg_img.'" alt="img"></div>
                  <div class="info" style="'.$square_bg.'" >
                    <h3>'.$thumbtitle.'</h3>
                    <p style="color:'.$thumb_des.';">'.$thumbdesc.'</p>
                  </div></a></div>';
    }

    return $html;


  }
	
} ?>
