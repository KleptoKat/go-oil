<div class="jumbotron">
  <h1 class="display-3">Fleet Service</h1>
</div>

<div class="form_fleet">
  <?php echo form_open('fleet'); ?>
  <div class="row">
    <div class="col-lg-3 col-md-6 text-center">
      <div class="service-box mt-5 mx-auto">
        <i class="fa fa-4x fa-desktop text-primary mb-3 sr-icons"></i>
        <h3 class="mb-3">Online</h3>
        <p class="text-muted mb-0">Our online tools make it easy to service your entire fleet and manage invoices, billing, and service records.</p>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 text-center">
      <div class="service-box mt-5 mx-auto">
        <i class="fa fa-4x fa-dollar text-primary mb-3 sr-icons"></i>
        <h3 class="mb-3">Onsite</h3>
        <p class="text-muted mb-0">We come to you, saying downtime and labor. Whether it's on the parking lot or in the field we can service anywhere.</p>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 text-center">
      <div class="service-box mt-5 mx-auto">
        <i class="fa fa-4x fa-close text-primary mb-3 sr-icons"></i>
        <h3 class="mb-3">No Upsell Policy</h3>
        <p class="text-muted mb-0">Unlike most service providers, Go Oil believes in the 'No Upsell' policy which means after you book your oil change you will not be asked or pressured into getting extra and often unnecessary services.</p>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 text-center">
      <div class="service-box mt-5 mx-auto">
        <i class="fa fa-4x fa-clock-o text-primary mb-3 sr-icons"></i>
        <h3 class="mb-3">24/7 Service</h3>
        <p class="text-muted mb-0">You can have your vehicles serviced anytime day or night. We can meet you company's specific needs.</p>
      </div>
    </div>
  </div>
  <br>
    <div class="fleet_info">
      <h5>The Go Oil mobile oil change is making it easier for businesses to service their fleets. We come to you 24/7 so your vehicles can get their oil change and basic services during downtime instead of paying employees during working hours. Making the switch will save you time, money, and headaches. All prices are quoted exactly to each vehicle and the bill comes direct to you, no surprises.</h5>
      <br>
      <h4><strong>Special Service Vehicles</strong></h4>
      <br>
      <h5>Go Oil service vans are equipped with a unique oil vac system that sucks the used oil from the top of the engine eliminating the risk of spills. This also results in a cleaner and faster oil change that can be performed anywhere safely whether that's roadside, in a compound, or at the jobsite. We contain the waste oil in sealed disposal tanks and recycle all used oil with environmentally responsible partners.</h5>
      <br>
      <h4><strong>Premium Suppliers</strong></h4>
      <br>
      <h5>Every service completed uses only the highest spec and quality oil available in Canada. It will meet or exceed all requirements of the manufacturer at a competitive price. Records are kept of every service and are accessible in the event of any warranty claims.</h5>
      <br>
      <h4><strong>Commercial Account Advantage</strong></h4>
      <br>
      <h5>A commercial account with Go Oil will give you access to special price rates, and a personal account manager. The discount rates are calculated based upon the number of vehicles, size of the vehicles, and how many services are required per year. We are authorized to service many fleet management companies, but if yours is not one of them we are taking on more every day so just let us know.</h5>
      <br>
      <h5>Please submit your information below to get more info on our fleet services and arrange a demo! We will contact you within one business day, thanks for your consideration!</h5>
    </div>
    <h3>CONTACT US</h3>
    <div id="fleet_section">
      <div id="fleet_name" class="form-group">
        <div class="name">
          <label for="name">Name:</label>
            <input name="name" type="text" class="form-control" id="fleet_name_input">
          <div class="error">
            <small> <?= form_error('name') ?> </small>
          </div>
          <div class="collapse" id="fieldRequired3">
            <div class="error">
              <small>Name is required.</small>
            </div>
          </div>
        </div>
      </div>

      <div id="fleet_email" class="form-group">
        <label for="email">Email:</label>
          <input name="email" type="email" class="form-control" id="fleet_email_input">
        <div class="error">
          <small> <?= form_error('email') ?> </small>
        </div>
        <div class="collapse" id="fieldRequired3">
          <div class="error">
            <small>Email is required.</small>
          </div>
        </div>
      </div>

      <div id="fleet_phone" class="form-group">
        <label for="phone">Phone:</label>
          <input name="phone" type="tel" class="form-control" id="fleet_phone_input">
        <div class="error">
          <small> <?= form_error('phone') ?> </small>
        </div>
        <div class="collapse" id="fieldRequired3">
          <div class="error">
            <small>Phone number is required.</small>
          </div>
        </div>
      </div>

      <div id="fleet_city" class="form-group">
        <label for="city">City:</label>
          <input name="city" type="text" class="form-control" id="fleet_city_input">
        <div class="error">
          <small> <?= form_error('city') ?> </small>
        </div>
        <div class="collapse" id="fieldRequired3">
          <div class="error">
            <small>City is required.</small>
          </div>
        </div>
      </div>

      <div id="fleet_number" class="form-group">
        <label for="numberOfVehicles">Number of Vehicles:</label>
          <input name="numberOfVehicles" type="text" class="form-control" id="fleet_number_input">
        <div class="error">
          <small> <?= form_error('numberOfVehicles') ?> </small>
        </div>
        <div class="collapse" id="fieldRequired3">
          <div class="error">
            <small>Number of vehicles is required.</small>
          </div>
        </div>
      </div>

      <div id="fleet_business" class="form-group">
        <label for="typeOfBusiness">Type of Business:</label>
          <input name="typeOfBusiness" type="text" class="form-control" id="fleet_business_input">
        <div class="error">
          <small> <?= form_error('typeOfBusiness') ?> </small>
        </div>
        <div class="collapse" id="fieldRequired3">
          <div class="error">
            <small>Type of business is required.</small>
          </div>
        </div>
      </div>
    </div>

    <div id="fleet_message" class="form-group">
      <label for="message">Message:</label><br>
      <textarea name="message" class="form-control" rows="4" class="message_input"></textarea>
    </div>

    <div class="fleet_button">
      <input id="fleetSubmit" type="button" class="btn btn-primary" value="Submit"></input>
    </div>

    <div class="modal fade" id="confirmFleetEmail" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h2 class="modal-title" id="modalLabel">Submit Fleet Services Form?</h2>
          </div>
          <div class="modal-footer">
            <button  id="noRequest" type="button" class="btn btn-default">No</button>
            <button id="submit_fleet" type="submit" name="submit" class="btn btn-primary" value="submit">Submit</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
