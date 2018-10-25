<div class="jumbotron">
  <h1 class="display-3">Franchise</h1>
</div>

<div class="form_franchise">
  <?php echo form_open('franchise'); ?>
    <div class="fran_info">
      <h4><strong>What Makes a Go Oil Franchise a Great Investment</strong></h4>
      <div class="fran_subInfo">
        <p>Everyday more services are going mobile and on-demand. With $1 Billion in oil changes done every year in Canada and mobile services trending there is huge market potential for the next few decades. It is considered a recession proof industry fluctuating very little even in the worst years. Scalability has been a problem in the past for mobile oil changes, but now with a highly automated software franchise owners can operate their business with minimal effort from their smartphone. Running multiple franchises is simpler than ever and can be managed through our simple software.</p>
      </div>
      <br>
      <h4><strong>Low Cost and Big Reward</strong></h4>
      <div class="fran_subInfo">
        <p>Starting a franchise with Go Oil is inexpensive and almost anyone can finance the setup. There is no need for construction or a brick and mortar location to get started. The van comes fully equipped, setup, and stocked with enough inventory to get started. With strong partnerships and buying power the margins on every oil change mean you can begin to make money from day one. An owner can get started full-time or part-time, and the pricing model allows an owner to pay someone else to do the oil changes while they’re sleeping or at work.</p>
      </div>
      <br>
      <h4><strong>Requirements What Does It Cost?</strong></h4>

        <h5>Startup Cost:</h5>
          <div class="fran_subInfoCost">
        <p>$15000 Franchise Fee</p>
        <p>$2500 Tools/Equipment</p>
        <p>Mercedes Metris Lease</p>
        <p>No monthly fees</p>
         </div>
        <h5>Requirements:</h5>
        <div class="fran_subInfoCost">
        <p>Must be financeable for vehicle lease</p>
        <p>Must have driver’s license</p>
        <p>Must be willing to talk to people and sell</p>
      </div>
      <br>
      <h4><strong>The Technology and Support</strong></h4>
      <div class="fran_subInfo">
        <p>With a custom built software every part of the Go Oil franchise is setup and done for you. With accurate quoting and automatic booking you don’t need to take phone phone calls or worry about invoices. You decide when you want to work and the program will automatically book clients into your schedule. Go Oil corporate takes care of payment collection, customer service, vendor relationships, and inventory costs. The only thing left for a Franchisee to worry about is local marketing and doing each and every service call with excellence.</p>
      </div>
      <br>
      <h4><strong>No Customer Service  Headaches or Taking Phone Calls</strong></h4>
      <div class="fran_subInfo">
        <p>If you’ve run a small business before it’s quite likely that most calls, emails, and complaints all find their way to your phone. These tasks, while they may be small, will constantly interrupt your productivity and ability to go out and make more money for your business. Imagine the simplicity of logging on daily and doing the jobs in front of you, and getting out into your community making yourself and services known.</p>
      </div>
      <br>
      <h4><strong>Always Get Paid</strong></h4>
      <div class="fran_subInfo">
        <p>One of the keys to success with Go Oil is that every oil change is prepaid and the franchise owner only pays for supplies at the point of the sale. This way you are guaranteed to be paid for every service appointment that you do, you won’t ever find yourself paying to have work done and going home empty handed. The only daily costs you need to worry about are your van lease, and insurance which make for very low overhead and a secure financial situation.</p>
      </div>
      <br>
      <h4><strong>Customer Base and Partnerships</strong></h4>
      <div class="fran_subInfo">
      <p>The Go Oil service network has allowed the corporate team to create partnerships with several associations and companies. Each city has more demand for our services than we can currently fulfill on our own and will be utilizing franchise owners. Go Oil is a certified vendor of several large fleet management companies and more are added every month. Since all clients are going through one central website Go Oil has a very strong online presence and will be able to take advantage of the traffic.</p>
      </div>
      <br>
      <h4><strong>Marketing Expertise and Ongoing Promotion</strong></h4>
      <div class="fran_subInfo">
        <p>With experience marketing in cities across Canada Go Oil can give you a competitive edge over the competition. A percentage of every sale is set aside and spent back into the territories that need it most. Materials and local strategies are developed every month and will be shared with every franchise owner and available to use.</p>
      </div>
      <br>
      <h4><strong>Training and Pre-built Service Vans</strong></h4>
      <div class="fran_subInfo">
        <p>Since we first started in 2017 we have gone through several designs and setups and now offer a fully pre-built and equipped service van. Each franchise owner will receive training when they start.</p>
      </div>
      <br>
    </div>
    <h3>CONTACT US</h3>
    <div id="franchise_name" class="form-group">
      <div class="firstname">
        <label for="firstname">First Name:</label>
          <input name="firstname" type="text" class="form-control" id="firstname">
        <div class="error">
          <small> <?= form_error('firstname') ?> </small>
        </div>
        <div class="collapse" id="fieldRequired3">
          <div class="error">
            <small>First name is required.</small>
          </div>
        </div>
      </div>

      <div class="lastname">
        <label for="lastname">Last Name:</label>
          <input name="lastname" type="text" class="form-control" id="lastname">
        <div class="error">
          <small> <?= form_error('lastname') ?> </small>
        </div>
        <div class="collapse" id="fieldRequired3">
          <div class="error">
            <small>Last name is required.</small>
          </div>
        </div>
      </div>
    </div>

    <div id="franchise_email" class="form-group">
      <label for="email">Email:</label>
        <input name="email" type="email" class="form-control" id="franchise_email_input">
      <div class="error">
        <small> <?= form_error('email') ?> </small>
      </div>
      <div class="collapse" id="fieldRequired3">
        <div class="error">
          <small>Email is required.</small>
        </div>
      </div>
    </div>

    <div id="franchise_phone" class="form-group">
      <label for="phone">Phone:</label>
        <input name="phone" type="tel" class="form-control" id="phone">
      <div class="error">
        <small> <?= form_error('phone') ?> </small>
      </div>
      <div class="collapse" id="fieldRequired3">
        <div class="error">
          <small>Phone number is required.</small>
        </div>
      </div>
    </div>

    <div id="franchise_city" class="form-group">
      <label for="city">City you are interested in:</label>
        <input name="city" type="text" class="form-control" id="franchise_city_input">
      <div class="error">
        <small> <?= form_error('city') ?> </small>
      </div>
      <div class="collapse" id="fieldRequired3">
        <div class="error">
          <small>City is required.</small>
        </div>
      </div>
    </div>

    <div id="franchise_message" class="form-group">
      <label for="message">Message:</label><br>
      <textarea name="message" class="form-control" rows="4" class="message_input"></textarea>
    </div>

    <div class="franchise_button">
      <input id="franchiseSubmit" type="button" class="btn btn-primary" value="Submit"></input>
    </div>

    <div class="modal fade" id="confirmFranchiseEmail" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h2 class="modal-title" id="modalLabel">Submit Franchise Form?</h2>
          </div>
          <div class="modal-footer">
            <button  id="noRequest" type="button" class="btn btn-default">No</button>
            <button id="submit_franchise" type="submit" name="submit" class="btn btn-primary" value="submit">Submit</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
