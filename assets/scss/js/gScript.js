$(document).ready(function($){

//   document.addEventListener('contextmenu', function(e) {
//     e.preventDefault();
//   });
//
//   document.onkeydown = function(e) {
//   if(event.keyCode == 123) {
//      return false;
//   }
//   if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
//      return false;
//   }
//   if(e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
//      return false;
//   }
//   if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
//      return false;
//   }
//   if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
//      return false;
//   }
// }

  var qty = 1;
  var mbTax = 1.13;

  $('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function() {

  });

  // $('.js-scroll-trigger').click(function() {
  //   $('.navbar-collapse').
  // });

  $("#login_button").click(function(){
    $.LoadingOverlay("show",{
        image       : "",
        fontawesome : "fa fa-car fa-spin",
        // fontawesomeAnimation  : "4s pulse"
      });
  });

  $("#bookingHistoryButton").click(function(){
    $.LoadingOverlay("show",{
        image       : "",
        fontawesome : "fa fa-car fa-spin",
        // fontawesomeAnimation  : "4s pulse"
      });
  });

  $("#logoutButton").click(function(e){
    e.preventDefault();

    $.LoadingOverlay("show",{
        image       : "",
        fontawesome : "fa fa-car fa-spin",
        // fontawesomeAnimation  : "4s pulse"
      });

      setTimeout(function () {
       window.location.href = "logout"; //will redirect to your blog page (an ex: blog.html)
    }, 2000); //will call the function after 2 secs.
  });

  $("#register_button").click(function(){
    $.LoadingOverlay("show",{
        image       : "",
        fontawesome : "fa fa-car fa-spin",
        // fontawesomeAnimation  : "4s pulse"z
      });
  });

  $("#stepTwoNext").click(function(){
    $.LoadingOverlay("show",{
        image       : "",
        fontawesome : "fa fa-car fa-spin",
        // fontawesomeAnimation  : "4s pulse"z
      });
  });

  $("#selectedVehicleSubmit").click(function(){
    $.LoadingOverlay("show",{
        image       : "",
        fontawesome : "fa fa-car fa-spin",
        // fontawesomeAnimation  : "4s pulse"z
      });
  });

  $("#modalDeleteButton").click(function(){
    $.LoadingOverlay("show",{
        image       : "",
        fontawesome : "fa fa-car fa-spin",
        // fontawesomeAnimation  : "4s pulse"z
      });
  });

  $("#bookquote").click(function(){
    $.LoadingOverlay("show",{
        image       : "",
        fontawesome : "fa fa-car fa-spin",
        // fontawesomeAnimation  : "4s pulse"z
      });
  });

  $("#submit_franchise").click(function(){
    $.LoadingOverlay("show",{
        image       : "",
        fontawesome : "fa fa-car fa-spin",
        // fontawesomeAnimation  : "4s pulse"z
      });
  });

  $("#submit_fleet").click(function(){
    $.LoadingOverlay("show",{
        image       : "",
        fontawesome : "fa fa-car fa-spin",
        // fontawesomeAnimation  : "4s pulse"z
      });
  });

  $("#engineAirFilter").click(function(){
    alert('ok');
  });

  $("#google_login_redirect").ready(function(){

  });

  $("#navButtonBoy").click(function(){
    $(".dropdown-menu").slideToggle(400);
  });

  $("#service_p").hide();

  $("#addService_p").hide();

  $("#infoClick").popover();


  $("#confirmChange").click(function(){
    $("#youSureModal").modal();
  });

  $("#viewSubTotal").click(function(){
    $("#subtotalModal").modal();
  });

  $("#confSave").click(function(){
    $.LoadingOverlay("show",{
        image       : "",
        fontawesome : "fa fa-car fa-spin",
        // fontawesomeAnimation  : "4s pulse"
      });
  });

  $("input[name=vehicleId]").each(function(){

    var $veId = $(this).val();

    $("#deleteVehicle_"+$veId).click(function(){
      $("#deleteVehicleModal_"+$veId).modal();

      $("#noSave_" + $veId).click(function(e){
        $("#deleteVehicleModal_"+$veId).modal('hide');
      });
    });

    $("#selectVehicle_"+$veId).click(function(){
      localStorage['subTotal'] = 0;
    });

  });

  $("#stepTwoNext_quoting").click(function(){
    localStorage['subTotal'] = 0;
  });



  $("#stepTwoNext").click(function(){
    localStorage['subTotal'] = 0;
  });

  $("#noSave").click(function(e){
    e.preventDefault();
    window.location.href = "account";
  });

  $("#subtotalModalBack").click(function(){
    $('#subtotalModal').modal('hide');
  });

  $("#noRequest").click(function(){
    $("#confirmQuotingEmail").modal('hide');
    $("#confirmBookingEmail").modal('hide');
    $("#confirmFranchiseEmail").modal('hide');
    $("#confirmFleetEmail").modal('hide');
  })

  $("#addvehicle_button").click(function(){
    $("#addVehicleModal").modal();
  });

  $("#editVehicle").click(function(){
    $("#editVehicleModal").modal();
  });

  $('#engineInfoModal').show();
  $('#engineInfoModal').click(function(){
    $("#engineModal").modal();
  });

  $('#vehicleUnitInfoModal').show();
  $('#vehicleUnitInfoModal').click(function(){
    $("#unitModal").modal();
  });

  $("#oilTypeDropDown").hide();
  $("#selectedOilTypeDropDown").hide();


  $('#logoutButton').click(function(){
    localStorage.clear();
  });

  $('#stepTwoNextHeavyBook').click(function(){
    $('#confirmBookingEmail').modal();
  });

  $('#stepTwoNextHeavyQuote').click(function(){
    $('#confirmQuotingEmail').modal();
  });

  $('#franchiseSubmit').click(function(){
    $("#confirmFranchiseEmail").modal();
  });

  $('#fleetSubmit').click(function(){
    $("#confirmFleetEmail").modal();
  })

  $("#vehicleMakeDropDown").attr('disabled', true);
  $("#vehicleModelDropDown").attr('disabled', true);
  $("#vehicleEngineDropDown").attr('disabled', true);
  $("#card_subtotal").attr('disabled', true);

  $("#termsOfService").click(function(){
    $("#termsOfServiceModal").modal();
  });

  $("#vonigoSubmit").attr('hidden', true);
  $("#selectedVehicleSubmit").attr('hidden', true);
  $("#viewSubTotal").attr('hidden', true);
  $("#totalCalcQuote").attr('hidden', true);


  var quoteErr = $("#yearErr, #makeErr, #modelErr, #engineErr");
  var quoteCollapseErr = $("#yearErrCollapse, #makeErrCollapse, #modelErrCollapse, #engineErrCollapse");

  var vehicleFields = $("#vehicleYearDropDown, #vehicleMakeDropDown, #vehicleModelDropDown, #vehicleEngineDropDown");

  $("#stepTwoNext_quoting").attr('hidden', true);
  $("#stepTwoNext").attr('hidden', true);

  $(vehicleFields).each(function(index, vehicF){

    $(this).focusout(function(){

    });

    $(vehicF).click(function(){
      $(quoteErr[index]).hide();
      $(quoteCollapseErr[index]).collapse('hide');

    });
  });

// $(window).scroll(function(){
//
//   var footer = $("#footer");
//   var subtotalDetails = $("#subtotal_detail");
//
//   var footer_top = footer.offset().top;
//   var subtotalDetails_top = subtotalDetails.offset().top;
//
//   var footer_bottom = footer_top + footer.height();
//   var subtotalDetails_bottom = subtotalDetails_top + subtotalDetails.height();
//
//   if(subtotalDetails_top >= footer_top)
//   {
//     $("#subtotal_detail").css("margin-bottom", "160px");
//   }
//   else if(footer_top <= footer_bottom && footer_top >= subtotalDetails_top)
//   {
//     $("#subtotal_detail").css("margin-bottom", "0px");
//   }
//
// });



  $("#stepTwoNext_checking").click(function(){
    var noErrors = false;

    $(vehicleFields).each(function(index, VehicleF){

      if($(vehicleFields[index]).val() == '')
      {
        $(quoteCollapseErr[index]).collapse('show');

        noErrors = false;
      }
      else
      {
         noErrors = true;
      }

    });

    if(!$('#terms_checkbox').is(':checked'))
    {
      // $("#terms_checkbox").collapse('show');
      alert('You must agree to our terms of service.');
    }
    else if($('#terms_checkbox').is(':checked') && noErrors == true)
    {
      $.LoadingOverlay("show",{
          image       : "",
          fontawesome : "fa fa-car fa-spin",
          // fontawesomeAnimation  : "4s pulse"z
        });
      $("#serviceBooking").submit();


    }

  })

  $("#stepTwoNext_bookingCheck").click(function(){
    var noErrors = false;

    $(vehicleFields).each(function(index, VehicleF){

      if($(vehicleFields[index]).val() == '')
      {
        $(quoteCollapseErr[index]).collapse('show');

        noErrors = false;
      }
      else
      {
         noErrors = true;
      }

    });

    if(!$('#terms_checkbox').is(':checked'))
    {
      // $("#terms_checkbox").collapse('show');
      alert('You must agree to our terms of service.');
    }
    else if($('#terms_checkbox').is(':checked') && noErrors == true)
    {
      $.LoadingOverlay("show",{
          image       : "",
          fontawesome : "fa fa-car fa-spin",
          // fontawesomeAnimation  : "4s pulse"z
        });
      $("#service_buttons").append('<input type="hidden" name="step" value="stepTwo">');

      $("#serviceBooking").submit();
    }

  });

 // Account -->

 var input_fields = $("#name, #city, #postalCode, #phoneNumber");
 var edit_fields = $('#edit_name, #edit_city, #edit_postalCode, #edit_phoneNumber');

  $(edit_fields).each(function(index, edit){
    $(edit).click(function(){
      var value = $(input_fields[index]).val();

      if($(input_fields[index]).prop("readOnly"))
      {
        $(input_fields[index]).prop("readOnly", false);
        $(input_fields[index]).focus();
        $(input_fields[index]).select();
      }

      $(input_fields[index]).keypress(function(e) {
            if(e.which == 13) {
                e.preventDefault();
                if($(input_fields[index]).val() != value)
                {
                  $("#saveModal").modal({
                    backdrop: 'static',
                    keyboard: false
                  });
                }
            }
        });

      $(input_fields[index]).focusout(function(){
        $(input_fields).prop("readOnly", true);

        if($(input_fields[index]).val() != value)
        {
          if($(input_fields[index]).val() == "")
          {
             $("#fieldRequired"+index).collapse('show');
             $(input_fields[index]).prop("readOnly", false);
             $(input_fields[index]).focus();
          }
          else
          {
            $("#saveModal").modal({
              backdrop: 'static',
              keyboard: false
            });
          }
        }
      });
    });
  });

  $("#confirm_addVehicle").click(function(){
    $.LoadingOverlay("show",{
        image       : "",
        fontawesome : "fa fa-car fa-spin",
        // fontawesomeAnimation  : "4s pulse"
      });
  });
// <-- Account


// Register -->

  $("#email").focusin(function(){
    $("#email_reg").hide();
  });

  $("#securityAnswer").focusin(function(){
    $("#securityAnswer_reg").hide();
  });

  $("#name").focusin(function(){
    $("#name_reg").hide();
  });

  $("#city").focusin(function(){
    $("#city_reg").hide();
  });

  $("#postalCode").focusin(function(){
    $("#postal_reg").hide();
  });

  $("#phoneNumber").focusin(function(){
    $("#phone_reg").hide();
  });

  $("#password").focusout(function(){

    var password = this.value;

    var passwordRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?!.* ).{8,16}$");

    if(!password.match(passwordRegex) && password != "")
    {
      $("#passwordCollapse").collapse('show');
      $("#password").select();

    }
    else
    {
      $("#passwordCollapse").collapse('hide');
    }

  });

  $("#password").focusin(function(){
    $("#password_reg").hide();
  });

  $("#confirmPassword").focusout(function(){
    var password = $("#password").val();
    var confirmPassword = this.value;

    if(password != confirmPassword)
    {
      $("#confirmPasswordCollapse").collapse('show');
    }
    else
    {
      $("#confirmPasswordCollapse").collapse('hide');
    }
  });

  $("#confirmPassword").focusin(function(){
    $("#confirmPassword_reg").hide();
  });

// <-- Register

// Booking -->

    $("#vehicleYearDropDown").change(function(){

      var selectedVehicleYear = $(this).val();

      var tokenName = ($('input[type=hidden]').attr('name'));
      var tokenHash = ($('input[type=hidden]').val());

       if(selectedVehicleYear == '')
       {
         clearDropDown();
         $("#vehicleMakeDropDown").attr('disabled', true);
         $("#vehicleModelDropDown").attr('disabled', true);
         $("#vehicleEngineDropDown").attr('disabled', true);
       }
       else
       {
         clearDropDown();

         $.ajax({
           url:"booking/get_vehicle_makes",
           type: "POST",
           data: {"car_year" : selectedVehicleYear, 'csrf_tkn' : tokenHash},
           dataType: "json",
           success: function(data){
             $('#vehicleMakeDropDown').html(data);
           },
           complete: function(){
             $('#vehicleMakeDropDown').attr('disabled', false);
           }
         })
       }
    });

    $("#vehicleMakeDropDown").change(function(){
      var selectedVehicleMake = $(this).val();
      var selectedVehicleYear = $("#vehicleYearDropDown").val();

      var tokenName = ($('input[type=hidden]').attr('name'));
      var tokenHash = ($('input[type=hidden]').val());

      if(selectedVehicleMake == '')
      {
        clearDropDown();
        // $("#vehicleMakeDropDown").attr('disabled', true);
        $("#vehicleModelDropDown").attr('disabled', true);
        $("#vehicleEngineDropDown").attr('disabled', true);
      }
      else
      {
        $('#vehicleModelDropDown').empty();
        $('#vehicleModelDropDown').html('<option value="">Select Model</option>');

        $('#vehicleEngineDropDown').empty();
        $('#vehicleEngineDropDown').html('<option value="">Select Engine</option>');

        $.ajax({
          url:"booking/get_vehicle_models",
          type: "POST",
          data: {"car_make" : selectedVehicleMake, "car_year" : selectedVehicleYear, 'csrf_tkn' : tokenHash},
          dataType: "json",
          success: function(data){
            $('#vehicleModelDropDown').html(data);
          },
          complete: function(){
            $('#vehicleModelDropDown').attr('disabled', false);
          }
        })
      }
    });

    $("#vehicleModelDropDown").change(function(){
      var selectedVehicleModel = $(this).val();
      var selectedVehicleMake = $("#vehicleMakeDropDown").val();
      var selectedVehicleYear = $("#vehicleYearDropDown").val();

      var tokenName = ($('input[type=hidden]').attr('name'));
      var tokenHash = ($('input[type=hidden]').val());

      if(selectedVehicleModel == '')
      {
        clearDropDown();
        $("#vehicleMakeDropDown").attr('disabled', true);
        $("#vehicleModelDropDown").attr('disabled', true);
        $("#vehicleEngineDropDown").attr('disabled', true);
      }
      else
      {
        $('#vehicleEngineDropDown').empty();
        $('#vehicleEngineDropDown').html('<option value="">Select Engine</option>');

        $.ajax({
          url:"booking/get_vehicle_engines",
          type: "POST",
          data: {"car_make" : selectedVehicleMake, "car_model" : selectedVehicleModel, "car_year" : selectedVehicleYear, 'csrf_tkn' : tokenHash},
          dataType : "json",
          success: function(data){
            $("#vehicleEngineDropDown").html(data);
          },
          complete: function(){
            $('#vehicleEngineDropDown').attr('disabled', false);
          }
        })
      }
    });

$('#vehicleEngineDropDown').change(function(){
  var selectedVehicleYear = $("#vehicleYearDropDown").val();
  var selectedVehicleMake = $("#vehicleMakeDropDown").val();
  var selectedVehicleModel = $("#vehicleModelDropDown").val();
  var selectedVehicleEngine = $(this).val();

  var tokenName = ($('input[type=hidden]').attr('name'));
  var tokenHash = ($('input[type=hidden]').val());

  if(selectedVehicleEngine == '')
  {
    clearDropDown();
    $("#vehicleMakeDropDown").attr('disabled', true);
    $("#vehicleModelDropDown").attr('disabled', true);
    $("#vehicleEngineDropDown").attr('disabled', true);
  }
  else
  {
    // Oil Capacity
    var oil_capacity = function()
    {
      var oilTemp = null;
      $.ajax({
        async: false,
        global: false,
        url:"booking/get_oil_capacity",
        type: "POST",
        data: {"car_make" : selectedVehicleMake, "car_model" : selectedVehicleModel, "car_year" : selectedVehicleYear, "car_engine" : selectedVehicleEngine, 'csrf_tkn' : tokenHash},
        dataType: "json",
        success: function(data){

          $("#oilInfo").append('<input type="hidden" name="oil_capacity" value="'+data+'">');

          oilTemp = data;
        }
      });

      return oilTemp;
    }();

    // Oil Weight
    var oil_weight = function()
    {
      var oilWeightTemp = null;
      $.ajax({
        async: false,
        global: false,
        url:"booking/get_oil_weight",
        type: "POST",
        data: {"car_make" : selectedVehicleMake, "car_model" : selectedVehicleModel, "car_year" : selectedVehicleYear, "car_engine" : selectedVehicleEngine, 'csrf_tkn' : tokenHash},
        dataType: "json",
        success: function(data){

          $("#oilInfo").append('<input type="hidden" name="oil_weight" value="'+data+'">');

          oilWeightTemp = data;
        }
      })
      return oilWeightTemp;
    }();

    localStorage['oilCap'] = oil_capacity;
    localStorage['oilWeight'] = oil_weight;
  }
});

$("#serviceBookingThree").ready(function(){

  var oil_weight = localStorage['oilWeight'];

  var tokenName = ($('input[type=hidden]').attr('name'));
  var tokenHash = ($('input[type=hidden]').val());

  $.ajax({
    async: false,
    global: false,
    url:"booking/get_oil_types",
    type: "POST",
    data:{'oil_weight' : oil_weight,'csrf_tkn' : tokenHash},
    dataType: "json",
    success: function(data){
      $("#oilTypeDropDown").html(data);
    }
  })

  $.ajax({
    async: false,
    global: false,
    url: "booking/get_all_services",
    type: "POST",
    data: {'csrf_tkn' : tokenHash},
    dataType: "json",
    success: function(data){
      $("#additionalServices").html(data)
    }
  })
});

$("#oil_checkbox").click(function(){
  if($(this).is(':checked'))
    {
      $("#oilTypeDropDown").show();
      $("#oilTypeDropDown").focus();
    }
    else
    {

      $("#oilTypeCollapse").collapse('hide');
      localStorage['subTotal'] = 0;

      $("#oilTypeDropDown").hide();
      $("#subTotalCalc").empty();
      $("#service").empty();
      $("#service_p").hide();
      $("#addService").empty();
      $("#addService_p").hide();
      $("#subTotalCalc").empty();
      $("#addService").empty();
      $("#addService_p").hide();
      $("#vonigo").empty();

      $("input[name=addService]").each(function(){
        this.checked = false;
      });

      $("#oilTypeDropDown").prop('selectedIndex', 0);
      $("#vonigoSubmit").attr('hidden', true);
      $("#viewSubTotal").attr('hidden', true);
      $("#totalCalcQuote").attr('hidden', true);


    }
});

$("#selectedOil_checkbox").click(function(){

  if($(this).is(':checked'))
    {
      $("#selectedOilTypeDropDown").show();
      $("#selectedOilTypeDropDown").focus();
    }
    else
    {
      $("#oilTypeCollapse").collapse('hide');
      localStorage['subTotal'] = 0;
      $("#selectedOilTypeDropDown").hide();
      $("#subTotalCalc").empty();
      $("#service").empty();
      $("#service_p").hide();
      $("#addService").empty();
      $("#addService_p").hide();
      $("#subTotalCalc").empty();
      $("#addService").empty();
      $("#addService_p").hide();
      $("#vonigo_selectedVehicle").empty();

      $("input[name=addService]").each(function(){
        this.checked = false;
      });


      $("#selectedOilTypeDropDown").prop('selectedIndex', 0);
      $("#selectedVehicleSubmit").attr('hidden', true);
      $("#viewSubTotal").attr('hidden', true);



    }
});


$("#oilTypeDropDown").change(function(){
  $("#vonigo").empty();

  var oil_type = $(this).val();
  var oil_weight = localStorage['oilWeight'];
  var oil_cap = localStorage['oilCap'];

  $("#subTotalCalc").empty();
  $("#addService").empty();
  $("#addService_p").hide();

  $("input[name=addService]").each(function(){
    this.checked = false;
  });

  var tokenName = ($('input[type=hidden]').attr('name'));
  var tokenHash = ($('input[type=hidden]').val());

  // Oil Price
  var oil_price = function()
  {
    var oilPriceTemp = null;
    $.ajax({
      async: false,
      global: false,
      url:"booking/get_oil_price",
      type: "POST",
      data: {'oil_weight' : oil_weight, 'oil_type' : oil_type, 'oil_cap' : oil_cap,'csrf_tkn' : tokenHash },
      dataType: "json",
      success: function(data){
        oilPriceTemp = data;
      }
    })

    $.ajax({
      async: false,
      global: false,
      url:"booking/get_priceID",
      type: "POST",
      data: {'oil_weight' : oil_weight, 'oil_type' : oil_type, 'csrf_tkn' : tokenHash },
      dataType: "json",
      success: function(data){
        $("#vonigo").append(data);
      }
    })

    return oilPriceTemp;
  }();
  localStorage['oilPrice'] = oil_price;

  localStorage['subTotal'] = 0;

  localStorage['subTotal'] = (parseFloat(localStorage['subTotal']) + parseFloat(localStorage['oilPrice'])).toFixed(2);

  $("input[name=priceItemCount]").remove();

  $("#vonigo").append('<input type="hidden" name="priceItemCount" value="'+qty+'" />')

  if(!isNaN(localStorage['subTotal']))
  {

    $("#subTotalCalc").html("<p>$"+localStorage['subTotal']+"</p>");

  }
  else
  {
      $("#subTotalCalc").empty();
      $("#addService").empty();
      $("#addService_p").hide();


      $("input[name=addService]").each(function(){
        this.checked = false;
      });
  }

  if($("#oilTypeDropDown").val() == '')
  {
    $("#oilTypeCollapse").collapse('show');
    $("#service").html('');
    $("#service_p").hide();
    // $("#addSerLegend").hide();
    // $("#additionalServices").hide();
    $("#vonigo").empty();
  }
  else
  {
    $("#addSerLegend").show();
    $("#additionalServices").show();
    $("#service_p").show();
    $("#oilTypeCollapse").collapse('hide');
    $("#service").html($("#oilTypeDropDown option:selected").text() +':  ' + localStorage['oilPrice']);
    $("#vonigoSubmit").attr('hidden', false);
    $("#viewSubTotal").attr('hidden', false);
    $("#totalCalcQuote").attr('hidden', false);

  }


});

$("#oilTypeDropDown").focusout(function(){
  if($(this).val() == "")
  {
    $("#oilTypeCollapse").collapse('show');
    $("#vonigoSubmit").attr('hidden', true);
    $("#totalCalcQuote").attr('hidden', true);
    $("#viewSubTotal").attr('hidden', true);

  }
});

$("#selectedOilTypeDropDown").focusout(function(){
  if($(this).val() == "")
  {
    $("#oilTypeCollapse").collapse('show');
    $("#selectedVehicleSubmit").attr('hidden', true);
    $("#viewSubTotal").attr('hidden', true);

  }
});

// Account contains a vehicle -->
$("#selectedOilTypeDropDown").change(function(){
  $("#vonigo_selectedVehicle").empty();

  var oil_type = $(this).val();
  var oil_weight = $('input:hidden[name=oilWeight]').val();
  var oil_cap = $('input:hidden[name=oilCapacity]').val();

  $("#subTotalCalc").empty();
  $("#addService").empty();
  $("#addService_p").hide();


  $("input[name=addService]").each(function(){
    this.checked = false;
  });

  var tokenName = ($('input[type=hidden]').attr('name'));
  var tokenHash = ($('input[type=hidden]').val());

  // Oil Price
  var oil_price = function()
  {
    var oilPriceTemp = null;
    $.ajax({
      async: false,
      global: false,
      url:"booking/get_oil_price",
      type: "POST",
      data: {'oil_weight' : oil_weight, 'oil_type' : oil_type, 'oil_cap' : oil_cap,'csrf_tkn' : tokenHash },
      dataType: "json",
      success: function(data){
        oilPriceTemp = data;
      }
    })

    $.ajax({
      async: false,
      global: false,
      url:"booking/get_priceID_selected",
      type: "POST",
      data: {'oil_weight' : oil_weight, 'oil_type' : oil_type, 'oil_cap' : oil_cap,'csrf_tkn' : tokenHash },
      dataType: "json",
      success: function(data){
        $("#vonigo_selectedVehicle").append(data);
        $("input[name=priceItemCount]").remove();

        $("#vonigo_selectedVehicle").append('<input type="hidden" name="priceItemCount" value="'+qty+'" />')
      }
    })

    return oilPriceTemp;
  }();
  localStorage['oilPrice'] = oil_price;

  localStorage['subTotal'] = 0;

  localStorage['subTotal'] = (parseFloat(localStorage['subTotal']) + parseFloat(localStorage['oilPrice'])).toFixed(2);

  if(!isNaN(localStorage['subTotal']))
  {

    $("#subTotalCalc").html("<p>$"+localStorage['subTotal']+"</p>");
  }
  else
  {
      $("#subTotalCalc").empty();
      $("#addService").empty();
      $("#addService_p").hide();


      $("input[name=addService]").each(function(){
        this.checked = false;
      });
  }

  if($("#selectedOilTypeDropDown").val() == '')
  {
    $("#oilTypeCollapse").collapse('show');
    $("#service").html('');
    $("#service_p").hide();
    // $("#addSerLegend").hide();
    // $("#additionalServices").hide();
    $("#selectedVehicleSubmit").attr('hidden', true);
    $("#viewSubTotal").attr('hidden', true);

    $("#vonigo_selectedVehicle").empty();
  }
  else
  {
    $("#addSerLegend").show();
    $("#additionalServices").show();
    $("#service_p").show();
    $("#oilTypeCollapse").collapse('hide');
    $("#service").html($("#selectedOilTypeDropDown option:selected").text() +':  ' + localStorage['oilPrice']);
    $("#selectedVehicleSubmit").attr('hidden', false);
    $("#viewSubTotal").attr('hidden', false);

  }

});

$("#addvehicleBooking").click(function(){
  $.LoadingOverlay("show",{
      image       : "",
      fontawesome : "fa fa-car fa-spin",
      // fontawesomeAnimation  : "4s pulse"
    });
    location.reload();
});
  // <-----

$("#totalCalc").click(function(){

  var additionalServiceTotal = 0;

  var tokenName = ($('input[type=hidden]').attr('name'));
  var tokenHash = ($('input[type=hidden]').val());

  $('.serviceBoxes:checkbox:checked').each(function(){

    var serviceName = $(this).val();

    var additionalServicePrice = function()
    {
      var servicePrice = null;
      $.ajax({
        async: false,
        global: false,
        url:"booking/get_service_price",
        type: "POST",
        data: {'serviceName' : serviceName, 'csrf_tkn' : tokenHash},
        dataType: "json",
        success: function(data){
          servicePrice = data;
        }
      })
      return parseFloat(servicePrice);
    }();
    additionalServiceTotal += parseFloat(additionalServicePrice);
  });

  localStorage['estimatedQuote'] = (parseFloat(additionalServiceTotal) + parseFloat(localStorage['oilPrice']).toFixed(2));

});

$("#vonigoSubmit").click(function(){
  $("#vonigo_form").submit();
});

$("#selectedVehicleSubmit").click(function(){
  $("#vonigo_formSelectedVehicle").submit();
});

$("#car_light_truck").click(function(){
  $("#serviceBooking").append('<input type="hidden" name="step" value="stepOne"><input type="hidden" name="vehicleType" value="car_light_truck">');

  $("#serviceBooking").submit();
});

$("#heavy_duty").click(function(){
  $("#serviceBooking").append('<input type="hidden" name="step" value="stepHeavyTruck"><input type="hidden" name="vehicleType" value="heavy_duty">');

  $("#serviceBooking").submit();
});

$("#equipment").click(function(){
  $("#serviceBooking").append('<input type="hidden" name="step" value="stepEquipment"><input type="hidden" name="vehicleType" value="equipment">');

  $("#serviceBooking").submit();
});

$("#heavyDutyEquipment").click(function(){
  $("#serviceBooking").append('<input type="hidden" name="step" value="stepHeavyTruck"><input type="hidden" name="vehicleType" value="heavy_duty">');

  $("#serviceBooking").submit();
})


$("#additionalServices").ready(function(){
  var $additionalServices = $("input[name=addService]");

  var tokenName = ($('input[type=hidden]').attr('name'));
  var tokenHash = ($('input[type=hidden]').val());


  $("#addSerLegend").hide();

  $additionalServices.each(function(){
    $(this).click(function(){

        if($(this).is(':checked'))
        {

          $("#engineAirFilterModal").modal();

          qty++;
          var servicePriceID = $("input[name=" + $(this).val() + "]").val();

          var serviceName = $(this).val();
          var isSingle = 'TRUE';

          $(this).attr("disabled", true);

          $.ajax({
            url:"booking/get_service_price",
            type: "POST",
            data: {'serviceName' : serviceName, 'isSingle' : isSingle, 'csrf_tkn' : tokenHash},
            dataType: "json",
            success: function(data){
              $("#addService_p").show();
              $("#addService").append(data);
            },
            complete: function(){
              $additionalServices.attr("disabled", false);
            }
          })

          $.ajax({
            url:"booking/get_service_price",
            type: "POST",
            data: {'serviceName' : serviceName, 'csrf_tkn' : tokenHash},
            dataType: "json",
            success: function(data){

              if(!isNaN(localStorage['subTotal']))
              {
                localStorage['subTotal'] = (parseFloat(localStorage['subTotal']) + parseFloat(data)).toFixed(2);

              }
              else
              {
                localStorage['subTotal'] = parseFloat(data).toFixed(2);
              }

              $("#subTotalCalc").html("<p>$"+localStorage['subTotal']+"</p>");
            }
          })

          $("#vonigo").append('<input id="_'+serviceName+'" type="hidden" name="priceItemID' + qty + '" value="'+servicePriceID+'"/> <input id="_'+serviceName+'" type="hidden" name="priceItemQty' + qty + '" value="1"/>')

          $("#vonigo_selectedVehicle").append('<input id="_'+serviceName+'" type="hidden" name="priceItemID' + qty + '" value="'+servicePriceID+'"/> <input id="_'+serviceName+'" type="hidden" name="priceItemQty' + qty + '" value="1"/>')

          $("input[name=priceItemCount]").remove();

          $("#vonigo").append('<input type="hidden" name="priceItemCount" value="'+qty+'" />')
          $("#vonigo_selectedVehicle").append('<input type="hidden" name="priceItemCount" value="'+qty+'" />')

          if(!$("#selectedOil_checkbox").is(':checked'))
          {
            $("#selectedVehicleSubmit").attr('hidden', false);
            $("#viewSubTotal").attr('hidden', false);

          }

          if(!$("#oil_checkbox").is(':checked'))
          {
            $("#vonigoSubmit").attr('hidden', false);
            $("#totalCalcQuote").attr('hidden', false);
            $("#viewSubTotal").attr('hidden', false);

          }
        }

        if(!$(this).is(':checked'))
        {
          var serviceName = $(this).val();

          $("#_"+serviceName+" ").remove();
          $("#_"+serviceName+" ").remove();

          $("p#"+$(this).val()+" ").remove();

          qty--;

          $("input[name=priceItemCount]").remove();

          $("#vonigo").append('<input type="hidden" name="priceItemCount" value="'+qty+'" />')

          $("#vonigo_selectedVehicle").append('<input type="hidden" name="priceItemCount" value="'+qty+'" />')

          $.ajax({
            url:"booking/get_service_price",
            type: "POST",
            data: {'serviceName' : serviceName, 'csrf_tkn' : tokenHash},
            dataType: "json",
            success: function(data){
              localStorage['subTotal'] = (parseFloat(localStorage['subTotal']) - parseFloat(data)).toFixed(2);


              if(localStorage['subTotal'] == 0)
              {
                $("#subTotalCalc").empty();
              }
              else
              {
                $("#subTotalCalc").html("<p>$"+localStorage['subTotal']+"</p>");
              }
            }
          })

          if(!$("#selectedOil_checkbox").is(':checked'))
          {
            $("#selectedVehicleSubmit").attr('hidden', true);
            // $("#viewSubTotal").attr('hidden', true);

          }

          if(!$("#oil_checkbox").is(':checked'))
          {
            $("#vonigoSubmit").attr('hidden', true);
            $("#totalCalcQuote").attr('hidden', true);
            // $("#viewSubTotal").attr('hidden', true);

          }

        }

      if($("#addService").is(':empty'))
      {
        $("#addService_p").hide();
      }
    });
  });

});

  // Quoting -- >

  $("#totalCalcQuote").click(function(){
    var vonigoDiv = $("#vonigo_quote").html();

    localStorage['vonigoDiv'] = vonigoDiv;
  });

  $("#estimatedQuote").ready(function(){
    $calcEstQuote = (mbTax * parseFloat(localStorage['subTotal'])).toFixed(2);
    $("#estimatedQuote").html("<h1>*$" + $calcEstQuote + "</h1>" );

    $("#estimatedQuote_2").append(localStorage['vonigoDiv']);

    $("#bookquote").click(function(){
      $("#vonigoQuote").submit();
    });
  });

  // <-- Quoting

function clearDropDown()
{
  $('#vehicleMakeDropDown').empty();
  $('#vehicleMakeDropDown').html('<option value="">Select Make</option>');

  $('#vehicleModelDropDown').empty();
  $('#vehicleModelDropDown').html('<option value="">Select Model</option>');

  $('#vehicleEngineDropDown').empty();
  $('#vehicleEngineDropDown').html('<option value="">Select Engine</option>');
}

$("#promotionCode").focusout(function(){

  $("input[name*='promo']").remove();

  $("#vonigo_client").append('<input type="hidden" name="promo" value="'+$(this).val()+'"/>')

  if($(this).val() == '')
  {
    $("input[name*='promo']").remove();
  }

});

// <-- Booking
});
