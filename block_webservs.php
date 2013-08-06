<?php
class block_webservs extends block_list {
	function init() {
		$this ->title=get_string('pluginname', 'block_webservs');
	}
/*function renderLinks() {
	global $USER, $DB;
	$DB->set_debug(true);
	$sql = 'SELECT webservs.name, webservs.uri FROM webservs, webservs_svc_bldg WHERE webservs_svc_bldg.serviceId = webservs.id AND webservs_svc_bldg.buildingId = ?';
	$bldgid = $DB->get_record_sql('SELECT id from {webservs_building} WHERE bldgname = ?', array($USER->department));
	$params = array($bldgid);
//	$results = $DB->get_records_sql_menu($sql, $params);
        $results = $DB->get_records_sql('SELECT a.id as id, a.name, a.uri FROM {webservs} a, {webservs_svc_bldg} b WHERE b.serviceId = a.id AND b.buildingId = ?', array($bldgid));
	foreach ($results as $result){
	$serName = $record->name;
	$serURI = $record->uri;
	echo '<p>'.fullname($serName).' can be found at '.fullname($serURI).'</p>';
}
}*/
function get_content() {
	global $USER, $DB;
	if (isloggedin() and !isguestuser()){
//	$DB->set_debug(true);
	if ($USER->institution=='Student'){
	$bldgid = $DB->get_record_sql('SELECT id from {webservs_building} WHERE bldgname = ?', array($USER->department)); //gets the bldgID to match on in the next step
	$results = $DB->get_records_sql('SELECT a.id as id, a.name, a.uri, a.roles FROM {webservs} a, {webservs_svc_bldg} b WHERE b.serviceId = a.id AND b.buildingId = ? AND a.roles IN (1,2) ORDER BY a.name', array($bldgid->id));
	if ($this->content !==null) {
		return $this ->content;
	}
	$this->content	= new stdClass;	
	$this->content->items = array();
	$this->content->icons = array();
	foreach ($results as $result) {
	//	$this->content->items[]="<a href=$result->uri Target=_blank> $result->name</a>";
		$this->content->items[] = html_writer::tag('a', $result->name, array('href' => $result->uri, 'Target'=>'_blank'));
	//	$this->content->icons[]="<img src=http://moodle-sandbox.hopkinsschools.org/1.png>";
		$this->content->icons[] = html_writer::empty_tag('img', array('class' => 'icon-bookmark'));
		}}
	else
//insert staff passport code here
	$bldgid = $DB->get_record_sql('SELECT id from {webservs_building} WHERE bldgname = ?', array($USER->department)); //gets the bldgID to match on in the next step
        $results = $DB->get_records_sql('SELECT a.id as id, a.name, a.uri, a.roles FROM {webservs} a, {webservs_svc_bldg} b WHERE b.serviceId = a.id AND b.buildingId = ? AND a.roles IN (1,3) ORDER BY a.name', array($bldgid->id));
        if ($this->content !==null) {
                return $this ->content;
        }
        $this->content  = new stdClass;
        $this->content->items = array();
        $this->content->icons = array();
        foreach ($results as $result) {
                //$this->content->items[]="<a href=$result->uri Target=_blank> $result->name</a>";
                  $this->content->items[] = html_writer::tag('a', $result->name, array('href' => $result->uri, 'Target'=>'_blank'));
                
                 // $this->content->icons[]="<img src=http://moodle-sandbox.hopkinsschools.org/1.png> ";
		  $this->content->icons[] = html_writer::empty_tag('img', array('class' => 'icon-bookmark'));              
}}
else {
	if ($this->content !==null) {
		return $this->content;
	}
	$this->content = new stdClass;
	$this->content->text = "You must be logged in to view these contents";
	$this->content->footer = '';
}
	return $this->content;
}
}

