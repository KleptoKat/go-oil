<div class="jumbotron">
 <h1 class="display-3">Test Page</h1>
 <h1 id="subtotalTest" class="display-3"></h1>
</div>
<div class="step_icon">
  <ul class="step_progress">
    <li class="active"></li>
    <li class="active"></li>
    <li class="active"></li>
    <li class="active"></li>
  </ul>
</div>
<br><br>
<h1 class="detail_title">What service(s) are you looking for?</h1>

<?php // TODO: Oil Selection ?>
<div id="oil_selection">
  <legend>Service:</legend>
    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#oilservicecollapse" aria-expanded="false" aria-controls="collapseExample">Oil Change</button>
    </div>
<div class="collapse" id="oilservicecollapse">
  <div class="card-body-oil-service">
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi facilisis dui eget euismod tincidunt. Vivamus nec maximus ligula, ut sodales eros. Sed sagittis iaculis congue.</p>
    <div class="oil_option">
      <input id="oil_checkbox" type="checkbox">
      <label for="oil_checkbox">Oil Change with Filter</label>
      <select id="oilTypeDropDown" name="oilType" class="custom-select"></select>
      <div class="collapse" id="oilTypeCollapse">
        <div class="error">
          <small>Please select an oil type</small>
        </div>
      </div>
    </div>
  </div>
</div>

<?php // TODO: Additional Services ?>
<div id="addEngineAirFilter_selection">
  <legend>Additional Services:</legend>
    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#addEngineAirFilterCollapse" aria-expanded="false" aria-controls="collapseExample">Add Engine Air Filter</button>
</div>
<div class="collapse" id="addEngineAirFilterCollapse">
  <div class="card-body-addEngineAirFilter-service">
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi facilisis dui eget euismod tincidunt. Vivamus nec maximus ligula, ut sodales eros. Sed sagittis iaculis congue.</p>
  </div>
</div>

<div id="addCabinAirFilter_selection">
    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#addCabinAirFilterCollapse" aria-expanded="false" aria-controls="collapseExample">Add Cabin Air Filter</button>
</div>
<div class="collapse" id="addCabinAirFilterCollapse">
  <div class="card-body-addCabinAirFilter-service">
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi facilisis dui eget euismod tincidunt. Vivamus nec maximus ligula, ut sodales eros. Sed sagittis iaculis congue.</p>
  </div>
</div>

<div id="addHeadLamp_selection">
    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#addHeadLampCollapse" aria-expanded="false" aria-controls="collapseExample">Add Headlamp</button>
</div>
<div class="collapse" id="addHeadLampCollapse">
  <div class="card-body-addHeadLamp-service">
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi facilisis dui eget euismod tincidunt. Vivamus nec maximus ligula, ut sodales eros. Sed sagittis iaculis congue.</p>
  </div>
</div>
