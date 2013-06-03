i<?php
class block_hakala extends block_base {
	function init() {
		$this ->title=get_string('pluginname', 'block_hakala');
	}
function get_content() {
	global $USER, $DB;
	$DB->set_debug(true);
	if ($this->content !==null) {
		return $this ->content;
	}
	$this->content	= new stdClass;	
	//$bldgname = $USER->department;
        $results = $DB->get_record_sql('SELECT id FROM {block_hakala_building} WHERE bldgname = ?', array($USER->department));
	$this->content->text ='' ;
	$this->content->footer = 'Footer Here...';
	return $this->content;
	}
}


