<div class="jumbotron">
  <h1 class="display-3">Vonigo</h1>
</div>

<?php if(isset($result)) :?>
  <small><?php print_r($result) ?></small>
<?php endif ?>

<?php if(isset($clientID)) :?>

  <h2><?php echo $clientID ?></h2>
<?php endif ?>

<?php if(isset($token_stuff)) :?>

  <!-- <h2><?php print_r($token_stuff) ?></h2> -->
<?php endif ?>

<?php if(isset($token)) :?>

<h2><?php print_r($token) ?> </h2>

<?php endif?>

<?php if(isset($contact)) :?>

<h2><?php print_r($contact) ?> </h2>

<?php endif?>

<?php if(isset($priceList)) :?>

<h2><?php print_r($priceList) ?></h2>
<?php endif ?>

<?php echo form_open('vonigo') ?>

<input name="submit" type="submit" class="btn btn-primary" value="submit"/>
<input name="submit" type="submit" class="btn btn-primary" value="token"/>
<input type="submit" name="submit" class="btn btn-primary" value="contact">
<input type="submit" name="submit" class="btn btn-primary" value="priceList">
</form>


<form action="https://gooil.vonigo.com/api/v1/data/Contacts/?securityToken=939&clientID=79" method="post">
  <input type="text" id="phoneNumber" name="phoneNumber" value="2041234567">
  <input type="text" id="firstName" name="firstName" value="Test">
  <input type="text" id="email" name="email" value="something@email.com">
  <input type="text" id="lastName" name="lastName" value="Name">
  <button type="submit" name="button">Post</button>
</form>


<form action="https://gooil.vonigo.com/external/data/" method="post">
    <input type="hidden" name="serviceTypeID" value="11" />
    <input type="hidden" name="clientTypeID" value="1" />
    <input type="hidden" name="clientID" value="151" />
    <input type="hidden" name="vehicleID" value="194">
    <input type="hidden" name="locationID" value="68" />
    <input type="hidden" name="contactID" value="193" />
    <input type="hidden" name="zip" value="R2X 1Z1" />

    <input type="hidden" name="priceItemCount" value="1" />

    <input type="hidden" name="priceItemID1" value="1000" />
    <input type="hidden" name="priceItemQty1" value="1" />
    <input type="hidden" name="priceItemValue1" value="500" />
    <button type="submit" name="button">Submit</button>
</form>


<button onclick="submitForm()">Submit Form</button>

<script>
    function submitForm() {
        var InputData = {
            firstName: "Chris",
            lastName: "Ruoyu",
            phoneNo: "(999) 999-9999",
            email: "kirat@aceproject.space",
            province: "MB",
            city: "Winnipeg",
            postalCode: "R2X 1Z1",
            streetAddress: "321 McDermott Ave",
            notes: "notes",
            priceOilChange: {
                id: 4801,
                qty: 1,
                value: 500,
                name: "Oil Change",
                description: "Blah blah blah "
            }
        }
        Vonigo.init(InputData, submitFormAfter)
    }

    function submitFormAfter(objErr) {
        if (objErr.errNo == 0) {
            alert("success in creating quote. Show appropriate error message to the user.")
        }
        else {
            alert("failed to save data into Vonigo. Show appropriate error message to the user. Error number = " + objErr.errNo + ", Error Description = " + objErr.errMsg)
        }
    }

</script>
