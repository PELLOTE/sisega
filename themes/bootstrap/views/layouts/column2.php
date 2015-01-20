<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="row">
    <div class="span3 span330">
        <div id="sidebar">
        <?php
            $this->widget('bootstrap.widgets.TbNav', array(
                'type'=> TbHtml::NAV_TYPE_LIST,
                'items'=> $this->menu,
                'htmlOptions'=>array('class'=>'well sidenav', 'data-spy'=>'affix', 'data-offset-top'=>'50'),
            ));
        ?>
        </div><!-- sidebar -->
    </div>
    <div class="span9 span910">
        <div id="content">
            <?php echo $content; ?>
        </div><!-- content -->
    </div>
</div>

<?php $this->endContent(); ?>