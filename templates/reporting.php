<?php /*
* Template Name: Reporting
*/
get_header(); ?>

<script src="<?php echo get_template_directory_uri(); ?>/js/chartist.min.js"></script>
<div class="container">
	<h1>Reporting</h1>
	<ul>
		<li>By Grade Range</li>
		<li>By County</li>
		<li>By School</li>
		<li>By Class</li>
		<li>By Module</li>
		<li>By Date Range</li>
	</ul>

<!-- 	Get module#
	Get Question
	Generate List of Labels from question meta
	Get answer data from session
	compute lists of seriees for each label -->
<?php 


//Need to add taxonomy for county
function get_classes_by_county($county_id){

}

function get_classes_by_school($school_id){
		
	$args = array(
		'post_type' => 'classes',
		'tax_query' => array(
			array(
				'taxonomy' => 'school',
				'field' => 'id',
				'terms' => $school_id
			)
		)
	);

	$posts = get_posts( $args );
	$ids = array();

	foreach ($posts as $post) {
		array_push($ids, $post->ID);		
	}

	return $ids;
}

function get_classes_by_id($class_id){

}

function get_classes_by_grade($grade_id){

}

function get_classes_by_grade_range($grade_id_start, $grade_id_end){

}

//This needs to be tracked by year/semester (checkboxes?)
function get_classes_by_date_range($year_start,$year_end){

}

//Get all individual arrays of ids
$schools = get_classes_by_school(22);


//Find Where Array Intersect (AND)
$result=array_intersect($a1,$a2,$a3);
print_r($result);
 
?>





<?php 
global $wpdb;
$module_id = 118;

// 	$answers = $wpdb->get_results( 
// 	"
// 	SELECT answers
// 	FROM sessions
// 	WHERE class_id = '$module_id'
// 	" 
// );

$answers = $wpdb->get_results( 
	"
	SELECT answers
	FROM sessions
	" 
);

	$all = array();


//Get all json answers from db and convert to one large array
 foreach ($answers as $answer) {

 	//get json string for each, decode, and push to answers array
 	$json = $answer->answers;
 	$json = stripslashes($json);
 	$row = json_decode($json,true);
 
 	//loop here to push all questions - maybe change $arr1 to 2d array
 	array_push($all, $row);
 }
 
 

//organize into array with [question_id] => string of answers
foreach ($all as $k=>$subArray) {
  foreach ($subArray as $id=>$value) {
    $sumArray[$id] = $sumArray[$id]  .$value . ',' ;
  }
}

 
//for each question get question name, label list, and count
foreach ($sumArray as $qid => $answer_string) {
	$question_title = get_the_title($qid);
	
	rtrim($answer_string, ",");echo $answer_string;
	$answer_array = explode(',', $answer_string);

	//count up values
	$counted = array_count_values($answer_array);

	$labels ='';
	$vals = '';
	$sep = '';
	foreach( $counted as $key => $value ) {
	    $labels .= $sep . "'" .$key. "'";
	    $vals .= $sep . $value;
	    $sep = ',';
	}

	echo "<h2>" . $question_title . "</h2>";
	echo "<br><strong>Labels</strong>:" . $labels;
	echo "<br><strong>Vals</strong>:" . $vals; ?>

	<div id="<?php echo 'question' . $qid; ?>" class="ct-chart ct-golden-section "></div>
	<script>
 
 new Chartist.Bar(<?php echo '"#question' . $qid.'"'; ?>, {

  	labels: [<?php echo $labels; ?>],
  	
  	series: [<?php echo $vals; ?>]
	}, {
  	distributeSeries: true,
  	axisY: {
   	   onlyInteger: true
  	}


});
 
</script>

	<?php 
 

 
}


?>
 



	





</div>












<?php get_footer(); ?>