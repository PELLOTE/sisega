<?php
/**
 * Bootstrap swtich
 * https://github.com/nostalgiaz/bootstrap-switch
$('#mySwitch').bootstrapSwitch('toggleActivation');
$('#mySwitch').bootstrapSwitch('isActive');
$('#mySwitch').bootstrapSwitch('setActive', false);
$('#mySwitch').bootstrapSwitch('setActive', true);
$('#mySwitch').bootstrapSwitch('toggleState');
$('.mySwitch').bootstrapSwitch('toggleRadioState'); // the radiobuttons need a class not a ID, don't allow uncheck radio switch
$('.mySwitch').bootstrapSwitch('toggleRadioStateAllowUncheck'); // don't allow uncheck radio switch
$('.mySwitch').bootstrapSwitch('toggleRadioStateAllowUncheck', false); // don't allow uncheck radio switch
$('.mySwitch').bootstrapSwitch('toggleRadioStateAllowUncheck', true); // allow uncheck radio switch
$('#mySwitch').bootstrapSwitch('setState', true);
$('#mySwitch').bootstrapSwitch('status');  // returns true or false
$('#mySwitch').bootstrapSwitch('destroy');
 */

class TbSwitch extends CWidget
{
  /**
   * @var string apply TbSwitch plugin to these elements.
   */
  public $target = '.statuspicker';
  
  /**
   * @var boolean use jQuery plugin, otherwise use Prototype plugin.
   */
  public $useJQuery = true;
  
  /**
   * @var boolean include un-minified plugin then debuging.
   */
  public $debug = true;
  
  /**
   * @var array native TbSwitch plugin options.
   */
  public $options = array();
  
  /**
   * @var int script registration position.
   */
  public $scriptPosition = CClientScript::POS_END;
 
  
  /**
   * @var protected array native TbSwitch plugin defaultOptions.
   */
  protected $defaultOptions = array();
  
  /**
   * Apply Chosen plugin to select boxes.
   */
 
    public function init()
    {
        $this->defaultOptions = array(
            'data-on-label' => Yii::t('app', 'ON'),
            'data-off-label' => Yii::t('app', 'OFF')  
        );
    }
  
  public function run()
  {
    // Publish extension assets
    $assets = Yii::app()->getAssetManager()->publish( dirname(__FILE__) . '/assets' );

    // Register extension assets
    $cs = Yii::app()->getClientScript();
    $cs->registerCssFile( $assets . '/css/bootstrap-switch.css' );
    
    // Get extension for JavaScript file
    //$ext = '.min.js';
    $ext = '.min.js';
    if( $this->debug )
      $ext = '.js';
    
    // Use jQuery plugin version
    if( $this->useJQuery )
    {
      // Register jQuery scripts
//      $options = CJavaScript::encode(CMap::mergeArray($this->defaultOptions, $this->options));
//      $options = CJavaScript::encode( $this->options );
        $options = array_merge($this->options, $this->defaultOptions);   
      $cs->registerScriptFile( $assets . '/js/bootstrap-switch' . $ext,
        $this->scriptPosition );

      $cs->registerScript( 'TbSwitch',
        "$('{$this->target}').wrap('<div class=\"switch\" data-on-label=\"".Yii::t('app', $options['data-on-label'])."\" data-off-label=\"".Yii::t('app', $options['data-off-label'])."\" />').parent().bootstrapSwitch();", CClientScript::POS_READY );
        
    }
  }
}
?>