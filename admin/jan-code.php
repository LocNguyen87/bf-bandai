<div class="wrap">
  <div class="uk-section uk-section-default">
    <div class="uk-container">
      <div class="uk-grid-match uk-child-width-1-1@m" uk-grid>
        <div>
            <p>Input the JAN code:</p>
            <div class="uk-inline">
                <input class="uk-input uk-form-large" id="janCodeTxt">
            </div>
            <div class="uk-margin">
              <button class="uk-button uk-button-primary" id="searchJanBtn">Search</button><img id="loadingIcon" src="<?php echo BFBANDAI_URL.'/images/loading.svg'; ?>" />
            </div>
        </div>
        <div>
          <div class="uk-margin" id="searchResult">
            <div class="uk-card uk-card-primary uk-card-hover uk-card-body">
                <h3 class="uk-card-title">Product Data</h3>
                <dl class="uk-description-list uk-description-list-divider">
                    <dt>JAN Code / jan_cd</dt>
                    <dd></dd>
                    <dt>Description term</dt>
                    <dd>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</dd>
                    <dt>Description term</dt>
                    <dd>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</dd>
                </dl>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


</div>
