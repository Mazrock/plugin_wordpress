<?php
/*
Plugin Name: Do I have twice the same article
Description: Plugin verifying if two articles are alike
version: 0.1
Author: Ourmazde Broomand
*/
$wpdupecop_options=get_option("wpdupecopsettings");
//original article

$original = $wpdupecop_options['original'];

//new article

$rewritten = $wpdupecop_options['rewrite'];

//compare articles
$wp_dupecopfunction = similar_text($original,$rewritten,$result);

//admin page
function wp_dupe_cop_page(){
	global $wpdupecop_options;
	global $result;
	ob_start();?>

	<div class="wrap">
		<form action="options.php" method="POST">

		<?php settings_fields('wpdupecopgroup');?>	
			<h1>Wordpress Dupecop Settings</h1>
			<p>
			<h3>Past your original article here</h3>
			</p>
			<textarea name="wpdupecopsettings[original]" rows="20" cols="100"><?php echo $wpdupecop_options["original"];?></textarea>
			<p>
			<h3>Past your rewritten article here</h3>
			</p>
			<textarea name="wpdupecopsettings[rewrite]" rows="20" cols="100"><?php echo $wpdupecop_options["rewrite"];?></textarea>
			<p>
			<input type="submit" class="button-primary" value="compare spun articles">
			<input type="button" class="button" value="<?php echo $result.'%';?>">
			</p>
		</form>

	</div>
<?php
echo  ob_get_clean();
}

//admin tab
function wp_dupe_cop_tab(){
	add_options_page("wp_dupecop","WP_Dupecop","manage_options","wpdupecop","wp_dupe_cop_page");
}
add_action('admin_menu','wp_dupe_cop_tab');
//register settings
function wp_dupe_cop_setting(){
	register_setting("wpdupecopgroup","wpdupecopsettings");
}
add_action('admin_init','wp_dupe_cop_setting');