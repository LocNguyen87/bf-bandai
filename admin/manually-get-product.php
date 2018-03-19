<div class="wrap">
  <div class="uk-section uk-section-default">
    <div class="uk-container">
      <div class="uk-grid-match uk-child-width-1-1@m" uk-grid>
        <div>
            <h3>Start geting product from BANDAI API</h3>
            <p>Click below button to start getting products data from <strong><?php echo count(get_option('_jan_code_data')); ?></strong> JAN codes in list</p>
            <div class="uk-margin">
              <button class="uk-button uk-button-primary uk-width-1-1" id="processGetProducts">Step 1: Get Data</button><img id="loadingIcon" src="<?php echo BFBANDAI_URL.'/images/loading.svg'; ?>" />
            </div>
            <p id="statusText"></p>
            <div class="uk-margin">
              <button class="uk-button uk-button-primary uk-width-1-1" id="processCreateProducts">Step 2: Create Products</button><img id="loadingIcon" src="<?php echo BFBANDAI_URL.'/images/loading.svg'; ?>" />
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
