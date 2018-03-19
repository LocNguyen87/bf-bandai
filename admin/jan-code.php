<div class="wrap">
  <div class="uk-section uk-section-default">
    <div class="uk-container">
      <div class="uk-grid-match uk-child-width-1-1@m" uk-grid>
        <div>
            <h3>Add new JAN code to list</h3>
            <p>Input the JAN code</p>
            <div class="uk-inline">
                <input class="uk-input uk-form-large" id="janCodeTxt">
            </div>
            <div class="uk-margin">
              <button class="uk-button uk-button-primary" id="addJanBtn">Add</button><img id="loadingIcon" src="<?php echo BFBANDAI_URL.'/images/loading.svg'; ?>" />
            </div>
            <p id="statusText">New JAN code added ! <strong><span id="numberOfJanCode"></span></strong> JAN codes available now.</p>
        </div>
      </div>
    </div>
  </div>
</div>
