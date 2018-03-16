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
	               		$test = get_option('data_jancode');
	               		// var_dump($test);
	               		// echo $test[0];
	               		foreach($test as $t){
	               			echo $t;
	               		}
	               		if(isset($_POST['submit'])){
	               			$jan_code = $_POST['data_jancode'];
	               			update_option( 'data_jancode', [$jan_code]);
	               		}
	               	?>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>