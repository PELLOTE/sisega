<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<a class="buttonwell" href="<?php echo "<?php echo Yii::app()->controller->createUrl('ver', array('id' => \$data->{$this->tableSchema->primaryKey}));?>"; ?>">
<div class="view well">

	<?php echo '<?php'; ?> echo GxHtml::encode($data->getAttributeLabel('<?php echo $this->tableSchema->primaryKey; ?>')); <?php echo '?>'; ?>:
        <?php echo '<?php'; ?> echo GxHtml::encode($data-><?php echo $this->tableSchema->primaryKey; ?>); <?php echo "?>\n"; ?>
	<br />

<?php
$count=0;
foreach ($this->tableSchema->columns as $column):
	if ($column->isPrimaryKey)
		continue;
	if (++$count == 7)
		echo "\t<?php /*\n";
?>
	<?php echo '<?php'; ?> echo GxHtml::encode($data->getAttributeLabel('<?php echo $column->name; ?>')); <?php echo '?>'; ?>:
<?php if (!$column->isForeignKey): 
       if (strtoupper($column->dbType) == 'TINYINT(1)'
				|| strtoupper($column->dbType) == 'BIT'
				|| strtoupper($column->dbType) == 'BOOL'
				|| strtoupper($column->dbType) == 'BOOLEAN'): ?>
	<?php echo '<?php'; ?> echo GxHtml::encode($data-><?php echo $column->name; ?>? Yii::t('app', 'Yes') : Yii::t('app', 'No')); <?php echo "?>\n"; ?>
<?php else: ?>
        <?php echo '<?php'; ?> echo GxHtml::encode($data-><?php echo $column->name; ?>); <?php echo "?>\n"; ?>
<?php endif;
      else: ?>
	<?php
	$relations = $this->findRelation($this->modelClass, $column);
	$relationName = $relations[0];
	?>
	<?php echo '<?php'; ?> echo GxHtml::encode(GxHtml::valueEx($data-><?php echo $relationName; ?>)); <?php echo "?>\n"; ?>
<?php endif; ?>
	<br />
<?php endforeach; ?>
<?php
if($count>=7)
	echo "\t*/ ?>\n";
?>

</div>
</a>