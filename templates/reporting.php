<?php /*
* Template Name: Reporting
*/
get_header(); ?>


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

	$answers = $wpdb->get_results( 
	"
	SELECT answers
	FROM sessions
	WHERE class_id = '$module_id'
	" 
);


	$answers = array();

 foreach ($answers as $answer) {

 	//get json string for each, decode, and push to answers array
 	$json = $answer->answers;
 	$json = stripslashes($json);
 	$row = json_decode($json,true);
 
 	//loop here to push all questions - maybe change $arr1 to 2d array
 	array_push($all, $row);
 

 	
 
 }
 
var_dump($all);







//Get labels? use actual questions from post here
 $labels1 = array_unique($arr1);


  

 //print_r(array_count_values($arr1));

 //counts up values for each and store in assoc array
 $counted = array_count_values($arr1);

  $labels ='';
  $vals = '';
  $sep = '';
	foreach( $counted as $key => $value ) {
	    $labels .= $sep . "'" .$key. "'";
	    $vals .= $sep . $value;
	    $sep = ',';
	}

	echo $labels;
	echo " ";
	echo $vals;

 

	?>



	<div id="q1" class="ct-chart ct-golden-section "></div>





</div>






<script src="<?php echo get_template_directory_uri(); ?>/js/chartist.min.js"></script>

<script>
 
 new Chartist.Bar('#q1', {

  	labels: [<?php echo $labels; ?>],
  	
  	series: [<?php echo $vals; ?>]
	}, {
  	distributeSeries: true,
  	axisY: {
   	   onlyInteger: true
  	}


});
 
</script>



<?php get_footer(); ?>