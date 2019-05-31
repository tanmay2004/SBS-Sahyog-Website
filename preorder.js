// Prebooking Atta JS >> Made By Tanmay Garg

var totalAmt = document.getElementById("sumTotal");
var itemAndPrice = {
  "Atta_500g": 50.00,
  "Panjeeri_250g": 100.00,
  "Panjeeri_100g": 50.00,
  "Sev_250g": 100.00,
  "Sev_100g": 50.00,
  "Cookies_4": 50.00
};

function validate () {
  if (getCurrPrice() == 0) {
    alert("Please add something to your order!");
    return false;
  }
   
  for (key in itemAndPrice) {
    if (getCurrItems(key) > 0) {
      newHiddenInput(key);
    }
  } 
  
  document.getElementById("cost").value = "Rs " + getCurrPrice() + ".00"; // For sending to php
  alert("Order placed successfully! Your total amounts to Rs " + getCurrPrice() + "!");
  return true;  
}

function newHiddenInput (item) {
  // Create a new input element inside the form of type hidden
  // Set its value as the items of the parameter, name must also be given
  var input = document.createElement("input");
  input.setAttribute("type", "hidden");
  input.setAttribute("name", ("QT-" + item));
  input.setAttribute("value", getCurrItems(item));
  document.getElementById("detailsForm").appendChild(input);
}

$(document).ready(function() {
  $("input:radio").change(function() {
    if ($(this).val() == "Parent") {
      // Add parent special fields and their requirements when it's clicked
      $(".parentForm").css("display", "block");
      $(".parentForm input").attr("required", true);
    } else {
      // Remove parent form and its requirement if person switches from parent to teacher mode
      $(".parentForm").css("display", "none");
      $(".parentForm input").removeAttr("required");
    }
  });
});

function incrItems (id) {
  var elem = document.getElementById(id);
  elem.innerHTML = getCurrItems(id) + 1;
  setTotal();  
}

function decrItems (id) {
  var elem = document.getElementById(id);
  if (getCurrItems(id) > 0) {
    elem.innerHTML = getCurrItems(id) - 1;
    setTotal();
  } 
}

function setTotal () {
  var standard = "Amount (to be paid in cash) is Rs ";
  var grandSum = 0;
  for (var key in itemAndPrice) {
    grandSum += getCurrItems(key) * itemAndPrice[key];
  }
  totalAmt.innerHTML = standard + (grandSum + ".00");
}

function getCurrItems (id) {
  var numNow = parseInt((document.getElementById(id)).innerHTML);
  return numNow;
}

function getCurrPrice () {
  return parseFloat((totalAmt.innerHTML).substring(34)); // gives the current price on the page
}