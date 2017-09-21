<?php
/**
 * Description of Journal
 *
 * @author Dave Packer
 */
class checkBoxListBuilder {
	public $db;
	public function __construct($db) {
		$this->db = $db;
	}
	
	public function getCheckBoxGroup($checkBoxID){
		return $this->r_getCheckBoxGroup($checkBoxID, true);
	}

	private function r_getCheckBoxGroup($masterID = NULL,$firstLevel = false){
		$a_checkBoxFamily = $this->getCheckBoxFamily($masterID);
		if($masterID == NULL && $a_checkBoxFamily == -1){
			return "<h3 id='noCheckBoxMessage'>There are no check boxes.</h3>";
		}
		if($a_checkBoxFamily == -1){
			return NULL;
		}
		ob_start();
		?>
		<?php
		foreach($a_checkBoxFamily as $thisCheckBox){ ?>
			<li data-id='<?php echo $thisCheckBox['check_box_id']; ?>' data-name='<?php echo  $thisCheckBox['check_box_name']; ?>' class="checkBox-li">
				<ol id="checkBoxFamily-<?php echo $thisCheckBox['check_box_id']; ?>" class="checkBoxFamily">
					<div class="checkBoxListItem" data-checkBox="<?php echo $thisCheckBox['check_box_id']; ?>">
						<input type="checkbox" 
								 id="checkBox-<?php echo $thisCheckBox['check_box_id']; ?>" 
								 data-checkBoxID="<?php echo $thisCheckBox['check_box_id']; ?>"
						/>
						<label for="checkBox-<?php echo $thisCheckBox['check_box_id']; ?>">
							<?php echo $thisCheckBox['check_box_name']; ?>
						</label>
						<div class="checkBoxOptions">
						</div>
					</div>
					<?php echo $this->r_getCheckBoxGroup($thisCheckBox['check_box_id']); ?>
				</ol>
			</li>	
		<?php } 
		return ob_get_clean();
	}
	
	public function getCheckBoxFamily($checkBoxID){
		if($checkBoxID == NULL){
			$select_query = "SELECT * FROM check_box WHERE check_box_parent_id IS NULL ORDER BY ifnull(sort_order,check_box_id)";
		}else{
			$select_query = "SELECT * FROM check_box WHERE check_box_parent_id = ? ORDER BY ifnull(sort_order,check_box_id)";
		}
		$a_q = [$checkBoxID];
		$select_result = $this->db->getRows($select_query,$a_q);
		if(count($select_result) > 0){
			return $select_result;
		}else{
			return -1;
		}
	}
	
	public function newCheckBox($curIndex){
		ob_start();
		?>
			<ol id="checkBoxFamily-<?php echo $curIndex; ?>" class="checkBoxFamily">
				<div class="checkBoxListItem"data-checkBox="<?php echo $curIndex; ?>">
					<input type="checkbox" id="checkBox-<?php echo $curIndex; ?>" data-checkBoxID="na" />
					<label id='checkBox-lbl-<?php echo $curIndex; ?>' for="checkBox-<?php echo $curIndex; ?>">
						<input type="text" class='checkBoxKeyEdit' id="checkBox-input-<?php echo $curIndex; ?>"/>
					</label>
					<div class="checkBoxOptions">
					</div>
				</div>
			</ol>
		<?php
		return ob_get_clean();
	}
}
