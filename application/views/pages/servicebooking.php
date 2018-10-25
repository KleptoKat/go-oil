<div class="jumbotron">
  <h1 class="display-3">Service Booking</h1>
  <h1 id="subtotalTest" class="display-3"></h1>
</div>
<?php if(isset($vehicleExists) && $vehicleExists == TRUE) :?>
  <?php echo form_open('booking', 'class="vehicleSelect"') ?>
    <div class="vehicle_selection">
      <div class="booking_step">
        <div id="vehicle_group" class="form-group">
          <strong><h4>Please select the vehicle for servicing.</h4></strong><br>
          <table class="vehicle_in_booking">
            <thead>
              <th class="colYear_booking">Year</th>
              <th class="colMake_booking">Make</th>
              <th class="colModel_booking">Model</th>
              <!-- <th class="colEngine_booking">Engine</th> -->
            </thead>
            <tbody>
              <?php foreach($vehicles['result'] as $row) :?>
                <?php echo form_open('booking') ?>
                <tr>
                  <td><?php echo $row->year; ?></td>
                  <td><?php echo $row->make; ?></td>
                  <td><?php echo $row->model; ?></td>
                  <!-- <td><?php echo $row->engine; ?></td> -->
                  <td id="select_icon"><button id="selectVehicle_<?php echo $row->id ?>" name="step" type="submit" value="vehicleSelect"><i class="fa fa-check-square-o" style="font-size:24px"></i></button></td>
                  <td id="delete_icon"><i id="deleteVehicle_<?php echo $row->id ?>" class="fa fa-close" style="font-size:24px"></i></td>
                  <input type="hidden" name="vehicleId" value="<?php echo $row->id ?>">
                </tr>
                <div class="modal fade" id="deleteVehicleModal_<?php echo $row->id ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h2 class="modal-title" id="modalLabel"> Are you sure?</h2>
                      </div>
                      <div class="modal-body">
                        <p>Delete <strong><?php echo $row->year.' '.$row->make.' '.$row->model ?></strong>  </p>
                      </div>
                      <div class="modal-footer">
                        <button  id="noSave_<?php echo $row->id ?>" type="button" class="btn btn-default">No</button>
                        <input id="modalDeleteButton" style="height: 35px;" name="delete" type="submit" class="btn btn-primary" value="Delete">
                      </div>
                    </div>
                  </div>
                </div>
                </form>
              <?php endforeach ?>
            </tbody>
          </table>
          <br>
          <button id="addvehicle_button" class="btn btn-primary" type="button" name="button">Add Vehicle</button><br>
          <a id="heavyDutyEquipment" href="javascript:void(null);">Heavy Duty or Equipment?</a>
          <?php echo form_open('booking',' id="serviceBooking"') ?>
        </form>
        </div>
      </div>
    </div>
  <?php echo form_close() ?>

  <div class="modal animated fade" id="addVehicleModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="modalLabel">Add Vehicle</h2>
        </div>
        <div class="modal-body" id="addVehicleContent">
          <?php if(isset($_SESSION['isLoggedIn'])) :?>
            <div class="form_add_vehicle">
             <?php if (isset($errorMessage)) :?>
               <div class="errorMessage">
                 <p><?=$errorMessage ?></p>
               </div>
             <?php endif ?>

             <?php echo form_open('addvehicle', 'class="add_vehicle"') ?>

               <legend>Vehicle:</legend>
               <div class="form-group">
                 <select id="vehicleYearDropDown" name="vehicleYear" class="custom-select">
                   <option value="" selected="">Select Year</option>
                   <?php foreach($vehicleYears as $year) : ?>
                     <option value="<?php echo $year->car_year ?>"><?php echo $year->car_year ?></option>
                   <?php endforeach ?>
                 </select>
                 <div class="error" id="yearErr">
                   <small> <?= form_error('year') ?> </small>
                 </div>
               </div>
               <div class="form-group">
                 <select id="vehicleMakeDropDown" name="vehicleMake" class="custom-select">
                   <option selected="">Select Make</option>
                 </select>
                 <div class="error" id="makeErr">
                   <small> <?= form_error('make') ?> </small>
                 </div>
               </div>
               <div class="form-group">
                 <select id="vehicleModelDropDown" name="vehicleModel" class="custom-select">
                   <option selected="">Select Model</option>
                 </select>
                 <div class="error" id="modelErr">
                   <small> <?= form_error('model') ?> </small>
                 </div>
               </div>
               <div class="form-group">
                 <select style="width: 269px;" id="vehicleEngineDropDown" name="vehicleEngine" class="custom-select">
                   <option selected="">Select Engine</option>
                 </select>
                 <i id="engineInfoModal" class="fa fa-info-circle" style="font-size:24px; outline:none;"></i>

                 <div class="error" id="engineErr">
                   <small> <?= form_error('engine') ?> </small>
                 </div>
               </div>

               <div class="form-group">
                 <input id="vehicleUnit" type="text" name="unit" placeholder="Unit Number" class="custom-select">
                    <i id="vehicleUnitInfoModal" class="fa fa-info-circle" style="font-size:24px; outline:none;"></i>
                    <div class="error">
                      <small> <?= form_error('unit') ?> </small>
                    </div>
               </div>

               <div class="form-group">
                 <input id="vehicleKilometers" type="number" name="kilometers" placeholder="Kilometers" class="custom-select">
                    <div class="error">
                      <small> <?= form_error('kilometers') ?> </small>
                    </div>
               </div>

               <div id="oilInfo">

               </div>

               <input id="addvehicleBooking" name="addvehicleBooking" type="submit" class="btn btn-primary" value="Confirm"/>
             </form>
            </div>
          <?php else :?>
            <?php show_404() ;?>
          <?php endif ?>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
<?php else :?>
  <?php if($serviceStep === 1) :?>
    <?php echo form_open('booking','class="service_booking" id="serviceBooking"') ?>
      <div class="step_icon">
        <ul class="step_progress">
          <li class="active"></li>
          <li></li>
          <li></li>
          <li></li>
        </ul>
      </div>
      <br>
      <h1 class="vehicle_type">What do you drive?</h1>
      <div class="vehicle_choice">
        <ul>
          <li><h3>Auto/Light Truck</h3><img id="car_light_truck" class="light_truck" src="/assets/img/lighttruck.jpg" alt="#" value="car_light_truck"></li>
          <li><h3>Heavy Duty Truck</h3><img id="heavy_duty"class="heavy_duty" src="/assets/img/heavyduty.png" alt="#" value="heavy_duty"></li>
          <li><h3>Equipment</h3><img id="equipment" class="equipment" src="/assets/img/equipment.png" alt="#" value="equipment"></li>
        </ul>
      </div>
    <?php echo form_close() ?>
  <?php elseif( $serviceStep === 2) :?>
    <div class="step_icon">
      <ul class="step_progress">
        <li class="active"></li>
        <li class="active"></li>
        <li></li>
        <li></li>
      </ul>
    </div>
    <br>
    <h1 class="detail_title">Enter Vehicle Details</h1>
    <?php echo form_open('booking','class="service_booking" id="serviceBooking"') ?>
      <div class="form_servicebooking">
          <div class="vehicle_detail">
            <div class="form-group">
              <label for="year">YEAR</label><br>
              <select id="vehicleYearDropDown" name="vehicleYear" class="custom-select">
                <option value="" selected="selected">Select Year</option>
                <?php foreach($vehicleYears as $year) : ?>
                  <option value="<?php echo $year->car_year ?>"><?php echo $year->car_year ?></option>
                <?php endforeach ?>
              </select>
              <div class="error">
                <small> <?= form_error('year') ?> </small>
              </div>
              <div class="collapse" id="yearErrCollapse">
                <div class="error">
                  <small>Please select a year.</small>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="make">MAKE</label><br>
              <select id="vehicleMakeDropDown" name="vehicleMake" class="custom-select">
                <option value="" selected="selected">Select Make</option>
              </select>
              <div class="error">
                <small> <?= form_error('make') ?> </small>
              </div>
              <div class="collapse" id="makeErrCollapse">
                <div class="error">
                  <small>Please select a make.</small>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="model">MODEL</label><br>
              <select id="vehicleModelDropDown" name="vehicleModel" class="custom-select">
                <option value="" selected="selected">Select Model</option>
              </select>
              <div class="error">
                <small> <?= form_error('model') ?> </small>
              </div>
              <div class="collapse" id="modelErrCollapse">
                <div class="error">
                  <small>Please select a model.</small>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="engine">ENGINE <i id="engineInfoModal" class="fa fa-info-circle" style="font-size:24px; outline:none; margin-left: 15px;"></i>
               </label>
              <br>
              <select id="vehicleEngineDropDown" name="vehicleEngine" class="custom-select">
                <option value="" selected="selected">Select Engine</option>
              </select>
              <div class="error">
                <small> <?= form_error('engine') ?> </small>
              </div>
              <div class="collapse" id="engineErrCollapse">
                <div class="error">
                  <small>Please select a engine.</small>
                </div>
              </div>
            </div>
          </div>
          <div class="additional_note">
            <div class="form-group">
              <label for="comment">ADDITIONAL COMMENTS</label><br>
              <textarea  name="comment" class="form-control" rows="4" class="note_input" placeholder="Do you have a different engine? Or is there anything else we need to know?"></textarea>
              <div class="error" id="dropdown_error">
              </div>
              <div class="form-group">
                <input id="terms_checkbox" type="checkbox" name="terms" value="terms">

                <label for="terms">You agree to our <a id="termsOfService" href="javascript:void(null);">Terms Of Service</a>.</label>
                <div class="error">
                  <small> <?= form_error('terms') ?> </small>
                </div>
              </div>
              <div id="service_buttons" class="service_buttons">
                <button id="stepTwoPrevious" type="submit" name="step" class="btn btn-primary" value="previousTwo">Previous</button>
                <button id="stepTwoNext" type="submit" name="step" class="btn btn-primary" value="stepTwo">Next</button>
                <button id="stepTwoNext_bookingCheck" type="button" name="step" class="btn btn-primary">Next</button>
                <!-- <input type="hidden" name="step" value="stepTwo"> -->
              </div>

              <div id="oilInfo">

              </div>
            </div>
          </div>

          <div class="modal animated fade" id="engineModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h2 class="modal-title" id="modalLabel">Don't know your engine type?</h2>
                </div>
                <div class="modal-body">
                  <ol>
                    <li>Look in your owner's manual.</li><br>
                    <li>Check your vehicle's registration documents.</li><br>
                    <li>Find the decal/sticker on the underside of your vehicle's hood.</li><br>
                    <li>Select the "I don't know" option.</li>
                  </ol>
                </div>
                <div class="modal-footer">
                </div>
              </div>
            </div>
          </div>

          <div class="modal animated fade" id="termsOfServiceModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h2 class="modal-title" id="modalLabel">Terms of Service</h2>
                </div>
                <div class="modal-body" id="termsOfServiceContent">
                  <p>By accessing our website, you, the user, agree to the terms and conditions we set out here. These terms and conditions may change at our discretion any time, and without notice. All orders and services or products made through this site are also governed by these terms and conditions.<br><br>

                  Use of and orders placed on this website by a Canadian based customer are governed by the laws and the courts of the province of Manitoba, and for orders placed by a customer in the United State of America by the applicable federal laws. The user is also responsible for complying with these laws.<br><br>

                  We may correct errors or inaccuracies and change or update information on this website at any time without notice, including prices and item availability. All prices listed are in local dollars and all charges will be processed in local dollars. All prices listed on this site are subject to confirmation. We reserve the right to limit the quantity of items that you may buy. We also reserve the right to cancel orders at our discretion.<br><br>

                  Online, telephone and in-person bookings may be subject to a minimum credit card pre-authorization charge endorsed through a payment channel on the site.  All service packages are quoted for items listed only within that service package.  Any service options or parts and associated labor that fall outside of a stipulated package are subject to additional labor and parts charges.  If a customer fails to attend or make themselves available for a pre-scheduled appointment, booking, corporate or team event, the pre-authorized could be forfeited.<br><br>

                  If you must cancel a booking, Go Oil requires that you provide a minimum 24 hour notice in advance of your scheduled appointment. This will allow time to re-book your Oil Change or other service time slot with another customer. Any booking cancelled outside the 24 hour notice period may forfeit the pre-authorized credit card amount taken at the time of booking. Go Oil also reserves the right to distribute promotional gift cards through partners, sponsors, contests and online competitions.  All promotional gift cards are to be used as a credit towards a service package and are not to be used as credit towards the procurement of parts, oil, or other product supplied by Go Oil Canada.<br><br>

                  Go Oil Canada will use commercially reasonable efforts to deliver service and items as quickly as possible, and within any time indicated. However, we are not responsible for service delays beyond our control that may fall outside of predetermined service schedules. We will endeavour to notify users if service is delayed and will offer up an alternative service date at the client's’ discretion. We reserve the right not to service or ship certain addresses at the sole discretion of Go Oil.<br><br>

                  <strong>Quoting and Oil Change Pricing</strong><br><br>

                  Specifications and pricing contained on this website are based on manufacturers' information and were believed accurate at the time of publication. Our recommendations apply to products offered by GO OIL CANADA.  Go Oil installs lubricants to what is considered adequate according to gradients on dipstick or level of filler hole. Go Oil Canada grants use of our system for quoting and booking oil changes with Go Oil Canada. Go Oil does not grant use or permission to copy or use this data for anything outside of Go Oil Canada. If used for outside purposes Go oil Canada may ban or take legal action.<br><br>

                  <strong>Copyright Considerations</strong><br><br>

                  All textual and graphic content on this site, its organization and presentation, and our organization and domain name are our property, and are therefore copyrighted by us. The materials on this site may not be copied, reproduced, posted, or republished in any way. They may be downloaded, displayed, or printed by the user for non-commercial and lawful personal use only. Otherwise, the republication or use of these materials on any other website without prior written consent from us is prohibited, and all rights are reserved.<br><br>

                  The trademarks, logos, and service marks displayed on this site are registered and unregistered trademarks of GO OIL CANADA and others, and so your own use of them is prohibited.<br><br>

                  Images of people used on this site are used with permission or in accordance with applicable law. Reuse of them without permission may violate the privacy and publication rights of those persons.<br><br>

                  <strong>Using Linked Content</strong><br><br>

                  This site provides links to other websites. All those sites are independent from GO OIL CANADA and therefore we have no control over, and no liability for, those websites or their contents, or their use. We provide these links for your convenience, and you decide to access them at your own risk.<br><br>

                  <strong>User-Provided Content</strong><br><br>

                  By submitting content, users warrant that they have full right and authority to submit that content, and that they have sole copyright and proprietary right over that content. Users may not contribute post or transmit unlawful, defamatory, or threatening material, that which would constitute or encourage criminal offenses, or violate any law. We reserve the right not to publish, or to remove, any content we deem inappropriate for any reason whatsoever.<br><br>

                  <strong>Our Liability</strong><br><br>

                  This website should be accessed and used at your own risk. Though reasonable efforts have been made to ensure the website is current and contains no inaccuracies or errors, no guarantees are made that the website’s content will be error-free, accurate, complete or current at all or any times. When a mistake is noticed, we will correct it as soon as possible and make reasonable efforts to notify affected users. This may mean that orders not yet shipped may be cancelled.<br><br>

                  We are not responsible for lost, incomplete, illegible, misdirected or stolen messages or mail, unavailable connections, failed, incomplete, garbled, or delayed transmissions, online failures, hardware, software, or other technical malfunctions or disturbances, whether or not these circumstances affect, disrupt, or corrupt communications.<br><br>

                  GO OIL CANADA and our directors and employees are not liable for any damages arising out of or related to access to or use of our site or our services, or sites we link to, whether or not these damages are foreseeable and whether or not we have been advised of the possibility, including, without limitation, direct, indirect, special, consequential, incidental or punitive damages.

                  </p>
                </div>
                <div class="modal-footer">
                </div>
              </div>
            </div>
          </div>
      </div>
    <?php echo form_close() ?>
  <?php elseif($serviceStep === 3 && isset($bool) && $bool == TRUE) :?>
    <div class="step_icon">
      <ul class="step_progress">
        <li class="active"></li>
        <li class="active"></li>
        <li class="active"></li>
        <li></li>
      </ul>
    </div>
    <br>
    <h1 class="detail_title">What can we do for you?</h1>

    <?php // TODO: EDIT FOR NEW STYLE ?>
    <br>
    <h4 class="vehicle_title"><?php echo $vehicle ?></h4>
    <?php echo form_open('booking','class="service_booking" id="serviceBookingThree"') ?>

    <!-- <div class="form_servicebooking"> -->
    <div id="oil_selection">
      <legend>Service:</legend>
        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#oilservicecollapse" aria-expanded="false" aria-controls="collapseExample">Oil Change</button>
        </div>
    <div class="collapse" id="oilservicecollapse">
      <div class="card-body-oil-service">
        <p>For your best price choose a conventional oil change! Semi-synthetic is a mix between synthetic and conventional oil for a middle price point. For your best quality and longest lasting oil choose synthetic. This is a high performance oil for any car. Every package includes a premium Wix oil filter!</p>
         <small style="font-style:italic; font-size:12px;">Go Oil recommends that you change your oil every 5000 km (for conventional oil) or when your vehicle notifies you that an oil change is needed.</small>
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

    <br><br>
    <div class="extra_service">
      <div id="add_selection">
        <legend>Additional Services:</legend>

      </div>

      <div id="additionalServices">
      </div>
    </div>
    <br><br>

    <!-- </div> -->
    <div class="subtotal_detail" id="subtotal_detail">
      <div class="card_subtotal">
        <div class="card border-secondary mb-3" style="max-width: 20rem;">
          <div class="card-header"><strong><h4>Subtotal:</h4></strong><h4 style='font-style: italic' id="subTotalCalc"></h4><button id='viewSubTotal' type="button" class="btn btn-primary">Next</button></div>
          <div class="card-body">
            <!-- <h4 style='font-style: italic' id="subTotalCalc"></h4> -->
            <div class="card-text">
            </div>
          </div>
        </div>
        <div id="subTotalCalc"></div>
      </div>
      <br><br>
      <div class="service_buttons">
      </div>
  </div>

    <div class="modal fade" id="subtotalModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h2 class="modal-title" id="modalLabel">Subtotal:</h2>

          </div>
          <div class="modal-body">
            <div style="font-style: italic">
              <p id="service_p"style="text-decoration : underline;">Service</p>
              <p id="service"></p>
              <p id="addService_p" style="text-decoration :underline;">Additional Services</p>
              <div id="addService"></div>
            </div>
            <div class="promotionCode">
              <label for="promo">Promo Code:</label>
              <input id="promotionCode" type="text" value=""> <button id="redeemButton" class="btn btn-default" type="button" name="redeem">Redeem</button>
            </div>
            <div class="collapse" id="validPromo">
              <div class="promotionValid">
                <small>Discount Added!</small>
              </div>
            </div>
            <div class="error">
              <div class="error" id="promoCodeError">
                <small>Promo code not valid.</small>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button  id="subtotalModalBack" type="button" class="btn btn-default">Back</button>
            <button id='vonigoSubmit' type="button" name="step" class="btn btn-primary" value="stepThree">Continue Booking</button>
          </div>
        </div>
      </div>
    </div>



  </form>

  <?php echo form_open('https://gooil.vonigo.com/external/data/index.aspx', 'id="vonigo_form"') ?>
  <div id="vonigo_client">
    <input type="hidden" name="serviceTypeID" value="<?php echo $_SESSION['serviceTypeID'] ?>"/>
    <input type="hidden" name="clientTypeID" value="<?php echo $_SESSION['clientTypeID'] ?>"/>
    <input type="hidden" name="clientID" value="<?php echo $_SESSION['clientID'] ?>"/>
    <input type="hidden" name="assetID" value="<?php echo $_SESSION['assetID'] ?>"/>
    <input type="hidden" name="locationID" value="<?php echo $_SESSION['locationID'] ?>"/>
    <input type="hidden" name="contactID" value="<?php echo $_SESSION['contactID'] ?>"/>
    <input type="hidden" name="zip" value="<?php echo $_SESSION['postalCode'] ?>"/>
    <input type="hidden" name="target" value="1"/>
  </div>
  <div id="vonigo">

  </div>

  <?php echo form_close() ?>

  <?php // TODO: EDIT FOR NEW STYLE ?>

    <!-- Account already contains vehicle(s) -->
  <?php elseif($serviceStep === 'selectedVehicle_1') :?>
    <div class="step_icon">
      <ul class="step_progress">
        <li class="active"></li>
        <li class="active"></li>
        <li class="active"></li>
        <li></li>
      </ul>
    </div>
    <br>
    <h1 class="detail_title">What can we do for you?</h1>
    <br>
    <h4 class="vehicle_title"><?php echo $vehicle ?></h4>
    <?php echo form_open('booking','class="service_booking" id="serviceBookingThree"') ?>
      <div>

    <!-- <div class="form_servicebooking"> -->

    <div id="oil_selection">
      <legend>Service:</legend>
        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#oilservicecollapse" aria-expanded="false" aria-controls="collapseExample">Oil Change</button>
        </div>
    <div class="collapse" id="oilservicecollapse">
      <div class="card-body-oil-service">
        <p>For your best price choose a conventional oil change! Semi-synthetic is a mix between synthetic and conventional oil for a middle price point. For your best quality and longest lasting oil choose synthetic. This is a high performance oil for any car. Every package includes a premium Wix oil filter!</p>
         <small style="font-style:italic; font-size:12px;">Go Oil recommends that you change your oil every 5000 km (for conventional oil) or when your vehicle notifies you that an oil change is needed.</small>
        <div class="oil_option">
          <input id="selectedOil_checkbox" type="checkbox">
          <input type="hidden" name="oilWeight" value="<?php echo $oilWeight ?>">
          <input type="hidden" name="oilCapacity" value="<?php echo $oilCapacity ?>">
          <label for="selectedOil_checkbox">Oil Change with Filter</label>
          <select id="selectedOilTypeDropDown" name="oilType" class="custom-select">
            <option value="">Select Oil Type</option>
            <?php foreach ($oilTypes as $oilType): ?>
                <option value="<?php echo $oilType ?>"> <?php echo $oilType ?></option>
            <?php endforeach; ?>
          </select>
          <div class="collapse" id="oilTypeCollapse">
            <div class="error">
              <small>Please select an oil type</small>
            </div>
          </div>
        </div>
      </div>
    </div>
      <!-- <div class="service_detail"> -->
        <br><br>
        <div class="extra_service">
          <div id="add_selection">
            <legend>Additional Services:</legend>

          </div>

          <div id="additionalServices">
          </div>
        </div>
        <br><br>

      <!-- </div> -->
      <div class="subtotal_detail" id="subtotal_detail">
        <div class="card_subtotal">
          <div class="card border-secondary mb-3" style="max-width: 20rem;">
            <div class="card-header"><strong><h4>Subtotal:</h4></strong><h4 style='font-style: italic' id="subTotalCalc"></h4><button id='viewSubTotal' type="button" class="btn btn-primary">Next</button></div>
            <div class="card-body">
              <!-- <h4 style='font-style: italic' id="subTotalCalc"></h4> -->
              <div class="card-text">
              </div>
            </div>
          </div>
          <div id="subTotalCalc"></div>
        </div>
        <br><br>
        <div class="service_buttons">
        </div>
    </div>

    <div class="modal fade" id="subtotalModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h2 class="modal-title" id="modalLabel">Subtotal:<h2 style='font-style: italic' id="subTotalCalc"></h2></h2>

          </div>
          <div class="modal-body">
            <div style="font-style: italic">
              <p id="service_p"style="text-decoration : underline;">Service</p>
              <p id="service"></p>
              <p id="addService_p" style="text-decoration :underline;">Additional Services</p>
              <div id="addService"></div>
            </div>
            <div class="promotionCode">
              <label for="promo">Promo Code:</label>
              <input id="promotionCode" type="text" value=""> <button id="redeemButton" class="btn btn-default" type="button" name="redeem">Redeem</button>
              <div class="collapse" id="validPromo">
                <div class="promotionValid">
                  <small>Discount Added!</small>
                </div>
              </div>
              <div class="error" id="promoCodeError">
                <small>Promo code not valid.</small>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button  id="subtotalModalBack" type="button" class="btn btn-default">Back</button>
            <button id='selectedVehicleSubmit' type="button" name="step" class="btn btn-primary" value="stepThree">Continue booking</button>
          </div>
        </div>
      </div>
    </div>

    <?php echo form_close() ?>
    <?php echo form_open('https://gooil.vonigo.com/external/data/index.aspx', 'id="vonigo_formSelectedVehicle"') ?>
    <div id="vonigo_client">
      <input type="hidden" name="serviceTypeID" value="<?php echo $_SESSION['serviceTypeID'] ?>"/>
      <input type="hidden" name="clientTypeID" value="<?php echo $_SESSION['clientTypeID'] ?>"/>
      <input type="hidden" name="clientID" value="<?php echo $_SESSION['clientID'] ?>"/>
      <input type="hidden" name="assetID" value="<?php echo $_SESSION['assetID'] ?>"/>
      <input type="hidden" name="locationID" value="<?php echo $_SESSION['locationID'] ?>"/>
      <input type="hidden" name="contactID" value="<?php echo $_SESSION['contactID'] ?>"/>
      <input type="hidden" name="zip" value="<?php echo $_SESSION['postalCode'] ?>"/>
      <input type="hidden" name="target" value="1"/>
    </div>
  <div id="vonigo_selectedVehicle">

  </div>

<?php echo form_close() ?>
  <?php elseif($serviceStep === 4) :?>
    <div class="step_icon">
      <ul class="step_progress">
        <li class="active"></li>
        <li class="active"></li>
        <li class="active"></li>
        <li class="active"></li>
      </ul>
    </div>

    <?php echo form_open('booking','class="form_onsite_contact" id="serviceBooking"') ?>
        <div class="form-group">
            <h3>Who will we be contacting?</h3>
          <div class="contact_info">
            <div class="contact_firstName">
              <label id="contact_firstName" for="firstName">First Name:</label>
              <input name="firstName" type="text" class="form-control" id="contact_firstName" value="<?php echo $firstName ?>" required>
            </div><br>
            <div class="contact_lastName">
              <label id="contact_lastName" for="lastName">Last Name:</label>
              <input name="lastName" type="text" class="form-control" id="contact_lastName" value="<?php echo $lastName ?>" required>
            </div><br>
            <div class="contact_phone">
              <label id="contact_phone" for="tel">Phone Number:</label>
              <input name="phone" type="tel" class="form-control" id="contact_phone" value="<?php echo $phoneNumber ?>" required>
            </div><br>
          </div>
          <button id="stepTwoPreviousHeavy" type="submit" name="step" class="btn btn-primary" value="previousThree">Previous</button>
          <button id="stepTwoNextHeavy" type="submit" name="step" class="btn btn-primary" value="stepFour">Next</button>
        </div>
    </form>

<?php elseif($serviceStep === 'heavyduty' || $serviceStep === 'equipment') :?>
  <?php echo form_open('booking','class="form_heavy_equipment" id="serviceBooking"') ?>
    <div class="form_heavy_equipment">
      <div class="form-group">
        <small>Please give a description of the vehicle you would like serviced. </small> <br>
        <small>You will be contacted for further booking.</small><br>
        <div class="heavyInfo">
          <div class="heavyName">
            <label id="heavyName" for="name">Name:</label>
            <input name="name" type="text" class="form-control" id="heavyName" placeholder="eg. Bruce Wayne">
          </div>
          <div class="error">
            <small> <?= form_error('name') ?> </small>
          </div><br>
          <div class="heavyEmail">
            <label id="heavyEmail" for="email">Email Address:</label>
            <input name="email" type="email" class="form-control" id="heavyEmail" aria-describedby="emailHelp" placeholder="eg. johndoe@example.com">
          </div>
          <div class="error">
            <small> <?= form_error('email') ?> </small>
          </div><br>
        </div>
        <div class="heavyVehicleInfo">
          <label id="heavyVehicleInfo" for="heavy_truck">Vehicle Information:</label> <br>
        <textarea name="heavy_truck" rows="8" cols="47" placeholder="eg. Really big truck that goes beep beep in reverse."></textarea> <br>
        <div class="error">
          <small> <?= form_error('name') ?> </small>
        </div>
        </div>
        <button id="stepTwoPreviousHeavy" type="submit" name="step" class="btn btn-primary" value="previousTwo">Previous</button>
        <button id="stepTwoNextHeavyBook" type="button" name="step" class="btn btn-primary" value="submitHeavyTruck">Submit</button>
      </div>
    </div>
    <div class="modal fade" id="confirmBookingEmail" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h2 class="modal-title" id="modalLabel">Send booking request?</h2>
          </div>
          <div class="modal-footer">
            <button  id="noRequest" type="button" class="btn btn-default">No</button>
            <button name="step" type="submit" class="btn btn-primary" value="submitHeavyTruck">Submit</button>
          </div>
        </div>
      </div>
    </div>
  </form>

<?php endif ?>
<?php endif ?>
