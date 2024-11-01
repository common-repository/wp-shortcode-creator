<?php
global $wpdb;
$prefix = $wpdb->prefix;
?>
<div class="wrap">
	<h1 class="bwsc_title"><?php esc_attr_e( 'Shortcode Creator Settings', 'wp_admin_style' ); ?></h1>
	<div id="bwsc_menu">
		<?php
		if( isset( $_GET['bwsc'] ) ) {
			if( $_GET['bwsc'] == 'e' ) {
				?>
				<div class="bwsc_button"><span><div class="dashicons dashicons-edit"></div> Edit Shortcode</span><span class="alignright">click to open</span></div>
				<div class="bwsc_content">
					<?php
					if( isset( $_GET['id'] ) ) {
						$id = esc_sql($_GET['id']);
						$result = $wpdb->get_results( "SELECT * FROM ".$prefix."bwshortcodecreator WHERE id=".$id."");
						if( $result ) {
							foreach( $result as $row ) {
								$shortcode_title = $row->shortcode_title;
								$shortcode_content = $row->shortcode_content;
								$shortcode_attributes = $row->shortcode_attributes;
								$shortcode_nicename = $row->shortcode_nicename;
								$shortcode_enable_php = $row->shortcode_enable_php;
								$shortcode_php = $row->shortcode_php;
								$shortcode_timestamp = $row->timestamp;
								$shortcode_id = $row->id;
								?>
								<p style="font-size: 15px;"><?php echo '<strong>Editing:</strong> '.$shortcode_nicename.' <i id="greyme">['.$shortcode_title; ?>]</i></p>
								<form method="post" action="">
									<input type="hidden" name="bwshortcodecreator_edit_shortcode_form_submitted" value="Y" />
									<input type="hidden" name="bwshortcodecreator_edit_shortcode_id" value="<?php echo $shortcode_id ?>" />
									
									<label for="bwshortcodecreator_shortcode_nicename">Shortcode Nice Name</label>
									<br />
									<input name="bwshortcodecreator_shortcode_nicename" id="bwshortcodecreator_shortcode_nicename" type="text" value="<?php echo $shortcode_nicename; ?>" class="regular-text" />
									
									<br />
									<br />
									
									<label for="bwshortcodecreator_shortcode_title">Shortcode Title</label>
									<br />
									<input name="bwshortcodecreator_shortcode_title" id="bwshortcodecreator_shortcode_title" type="text" value="<?php echo $shortcode_title; ?>" class="regular-text" />
									
									<br />
									<br />
									
									<label for="bwshortcodecreator_shortcode_content">Shortcode Content</label>
									<div id="poststuff">
										<?php the_editor(bwshortcodecreator_mynl2br($shortcode_content),'bwshortcodecreator_shortcode_content'); ?>
									</div>
									
									<br />
									<br />
									
									<!-- Coming Soon! ... Why are you in here anyway?... This is awkward... I'll just go...
									<label for="bwshortcodecreator_shortcode_attributes">Shortcode attributes</label>
									<br />
									<input name="bwshortcodecreator_shortcode_attributes" id="bwshortcodecreator_shortcode_attributes" type="text" value="<?php //echo $shortcode_attributes; ?>" class="regular-text" />
									<p>TODO: Make a premade attributes thing</p>
									
									<br />
									<br />-->
									
									<?php
									if($shortcode_enable_php == 1) {
										?>
										<input type="checkbox" name="bwshortcodecreator_shortcode_enable_php" id="bwshortcodecreator_shortcode_enable_php" checked /> <label>Enable custom PHP</label>
										<?php
									} else {
										?>
										<input type="checkbox" name="bwshortcodecreator_shortcode_enable_php" id="bwshortcodecreator_shortcode_enable_php" /> <label>Enable custom PHP</label>
										<?php
									}
									?>
									
									<p>Please note, checking this box will disable the text box above. It will still be saved, but not used until you uncheck the box, upon which the same will happen to the boc below</p>
									
									<br />

									<label for="bwshortcodecreator_shortcode_php">Shortcode PHP (Advanced)</label>
									
									<br />
									
									<?php
									if($shortcode_enable_php == 1) {
										?>
										<input type="text" name="bwshortcodecreator_shortcode_php" id="bwshortcodecreator_shortcode_php" class="regular-text" value="<?php echo $shortcode_php; ?>">
										<?php
									} else {
										?>
										<input type="text" name="bwshortcodecreator_shortcode_php" id="bwshortcodecreator_shortcode_php" class="regular-text" value="<?php echo $shortcode_php; ?>" disabled="disabled">
										<?php
									}
									?>
									<h3>How to use PHP in Shortcode Creator</h3>
									<p>Inside your function you must <strong>return</strong> your visible output, if any.</p>
									<ol>
										<li>Navigate to 'Appearance->Editor'</li>
										<li>On the top right, choose your current theme in the dropdown box and hit select</li>
										<li>On the right side, find your theme's 'functions.php' file</li>
										<li>In that file, create a function with any name you want, and write your PHP code within that function. If you need to include variables/parameters, set them before you define your function</li>
										<li>Now, you just have to call the function in the input above</li>
									</ol>
									<p>An example of correct use of the line above: <strong><i>my_fucntion();</i></strong> or <strong><i>my_fucntion($param1, $param2);</i></strong></p>
									<p><strong>WARNING:</strong> Do not type anything besides your function in the above input. You could break something otherwise.</p>
									<br />
									<br />
									
									<input class="button-primary" type="submit" name="bwshortcodecreator_edit_shortcode_submit" value="Save" />
								</form>
								
								<br />
								
								<form method="post" action="">
									<input type="hidden" name="bwshortcodecreator_delete_shortcode_form_submitted" value="Y" />
									<input type="hidden" name="bwshortcodecreator_shortcode_id" value="<?php echo $shortcode_id ?>" />
									<input class="button" type="submit" name="bwshortcodecreator_delete_shortcode_submit" id="bwshortcodecreator_delete_shortcode_submit" value="Delete Shortcode" />
								</form>
								<?php
							}
						} else {
							echo 'Sorry, that shortcode could not be found. Please try again later';
						}
					} else {
						echo 'Sorry, that shortcode could not be found. Please try again later';
					}
				?>
				</div>
				<?php
			}
		}
		?>
		<div class="bwsc_button"><span><div class="dashicons dashicons-plus"></div> New Shortcode</span><span class="alignright">click to open</span></div>
		<div class="bwsc_content">
			<form method="post" action="">
				<input type="hidden" name="bwshortcodecreator_new_shortcode_form_submitted" value="Y" />
	
				<label for="bwshortcodecreator_shortcode_title">Shortcode Title</label>
				<br />
				<input name="bwshortcodecreator_shortcode_title" id="bwshortcodecreator_shortcode_title" type="text" value="" class="regular-text" />
				<p>This is what you will type to call the shortcode. e.g. your shortcode will look like: [this_text_here]</p>
				
				<br />
				<br />
				
				<label for="bwshortcodecreator_shortcode_nicename">Shortcode Nice Name</label>
				<br />
				<input name="bwshortcodecreator_shortcode_nicename" id="bwshortcodecreator_shortcode_nicename" type="text" value="" class="regular-text" />
				<p>This is just the title for your shortcode</p>
				
				<br />
				<br />
				
				<input class="button-primary" type="submit" name="bwshortcodecreator_shortcode_title_submit" value="Save" />
			</form>
		</div>
		
		<div class="bwsc_button section_last" id="section_last"><span><div class="dashicons dashicons-admin-page"></div> All Shortcodes</span><span class="alignright">click to open</span></div>
		<div class="bwsc_content">
			<ul id="bwsc_list">
				<?php
				$result = $wpdb->get_results( "SELECT * FROM ".$prefix."bwshortcodecreator");
				$num_rows = $wpdb->num_rows;
				$count = 1;
				if(!$result == "") {
					foreach($result as $row) {
						if($count == $num_rows) {
							echo '<a href="?page=bwshortcodecreator&bwsc=e&id='.$row->id.'"><li id="bwsc_list_last">'.$row->shortcode_nicename.' <i class="alignright">['.$row->shortcode_title.']</i></li></a>';
						} else {
							echo '<a href="?page=bwshortcodecreator&bwsc=e&id='.$row->id.'"><li>'.$row->shortcode_nicename.' <i class="alignright">['.$row->shortcode_title.']</i></li></a>';
						}
						$count++;
					}
				} else {
					echo '<li>'.esc_attr_e( 'There are no shortcodes', 'wp_admin_style' ).'</li>';
				}
				?>
			</ul>
		</div>
	</div>
</div> <!-- .wrap -->