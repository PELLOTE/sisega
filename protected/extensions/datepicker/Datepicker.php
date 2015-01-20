<?php
/**
 * Datepicker class file.
 * https://github.com/eternicode/bootstrap-datepicker
 * http://eternicode.github.io/bootstrap-datepicker/
 */

class Datepicker extends CWidget
{
  /**
   * @var string apply chosen plugin to these elements.
   */
  public $target = '.datepicker';
  
  /**
   * @var boolean use jQuery plugin, otherwise use Prototype plugin.
   */
  public $useJQuery = true;
  
  /**
   * @var boolean include un-minified plugin then debuging.
   */
  public $debug = false;
  
  /**
   * @var array native Chosen plugin options.
   */
  public $options = array();
  
  /**
   * @var array native Chosen plugin options.
   */
  public $defaultOptions = array();  
  
  public $events = array();
  
  /**
   * @var int script registration position.
   */
  public $scriptPosition = CClientScript::POS_END;
  
    public function init()
    {
        if(empty($this->defaultOptions)) $this->defaultOptions = array('format' => Yii::app()->params['dateFormat'], 'weekStart' => 1, 'language' => 'es', 'autoclose' => true);
        $this->options = array_merge($this->defaultOptions, $this->options);
    }
  
  /**
   * Apply Chosen plugin to select boxes.
   */
  public function run()
  {
    // Publish extension assets
    $assets = Yii::app()->getAssetManager()->publish( dirname(__FILE__) . '/assets' );
    
    // Register extension assets
    $cs = Yii::app()->getClientScript();
    $cs->registerCssFile( $assets . '/css/datepicker.css' );
    
    // Get extension for JavaScript file
    //$ext = '.min.js';
    $ext = '.js';
    if( $this->debug )
      $ext = '.js';
    
    // Use jQuery plugin version
    if( $this->useJQuery )
    {
      // Register jQuery scripts
      $options = CJavaScript::encode( $this->options );
      $cs->registerScriptFile( $assets . '/js/bootstrap-datepicker' . $ext,
        $this->scriptPosition );
      if(isset($this->options['language'])){
        $cs->registerScriptFile( $assets . '/js/locales/bootstrap-datepicker.' . $this->options['language'] . $ext,
          $this->scriptPosition );
      }
      $cs->registerScript( "datepicker-{$this->target}",
        "$( '{$this->target}' ).datepicker({$options});", $this->scriptPosition );
    }
  }
}
?>