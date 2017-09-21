<?php
?>
<div class="centerMe">
	<h1>On the Table</h1>
</div>
<div class="checkBoxArea" id="">
	<ol id="onTheTable" class="sortableList">
		<?php echo $CheckBoxListBuilder->getCheckBoxGroup(NULL); ?>
	</ol>
	<ol id="onTheTable" class="sortableList">
		<?php echo $CheckBoxListBuilder->getCheckBoxGroup(NULL); ?>
	</ol>
	<div id='lowerButtonSlot'>
		<button id="addNewCheckBox-btn" onclick="addNewCheckBox()"><i class="material-icons">add</i></button>
	</div>
	<div id="checkBoxEditMenu">
		<div id="menu-arrow"></div>
		<a><i class="material-icons">arrow_downward</i></a>
		<a><i class="material-icons">subdirectory_arrow_right</i></a>
		<a><i class="material-icons">playlist_add</i></a>
	</div>
</div>