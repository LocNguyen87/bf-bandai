<div class="wrap">
   <h1>Add JAN code</h1>
   <div class="uk-section uk-section-default">
      <div class="uk-container">
         <div class="uk-grid-match uk-child-width-1-1@m" uk-grid>
            <div>
               <form action="" method="POST">
               		<div class="uk-inline">
               			<p class="medium-size-text">JAN code:</p>
	                	<input class="uk-input uk-form-large" type="text" name="data_jancode" id="data_jancode"/>
	               	</div>
	               	<div class="uk-inline">
						<input type="submit" name="submit" id="submit" class="uk-button uk-button-secondary" value="Save Changes">
	               	</div>
	               	<?php
	               		$current_option = get_option('data_jancode');
	               		if(isset($_POST['submit'])){
	               			$new_jan_code = $_POST['data_jancode'];
                      array_push($new_jan_code, $current_option);
	               			update_option( 'data_jancode', $new_jan_code);
	               		}
	               	?>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
