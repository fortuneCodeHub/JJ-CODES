/**
 * Frontend Js
 */

function itIsInArray(char, data) {
  for (let i = 0; i < data.length; i++) {
    if (data[i] == char) {
      return true
    }
  }
  return false
}

// Off canvas collapser
if (document.querySelector('#navbarSideCollapse')) {
  const navbarBtn = document.querySelector('#navbarSideCollapse');
  const navBg = document.querySelector('.offcanvas-collapse');
  const toggle = (function () {
      return function toggle() {
        navbarBtn.addEventListener('click', function () {
            navBg.classList.toggle('open');
        });
      }
  })();
  toggle();
}

// Nav-link activator
if (document.querySelectorAll(".nav-link")) {
  const navLinks = document.querySelectorAll(".nav-link")

  navLinks.forEach(navLink => {
    navLink.addEventListener("click", () => {
      removeActive(navLinks)
      toggleActive(navLinks)
    })
  });

  function removeActive(navLinks) {
    for (let i = 0; i < navLinks.length; i++) {
      navLinks[i].classList.remove("active")
    }
  }

  function toggleActive(navLinks) {
    navLinks.forEach(navLink => {
      let navLinkClass = navLink.classList
      for (let i = 0; i < navLinkClass.length; i++) {
        if (navLinkClass[i] == "active") {
          navLinkClass.remove("active");
        } else {
          navLinkClass.add("active");
        }
      }
    })
  }
}


// const items = document.querySelector(".item");

// owl carousel
$(document).ready(function() {
  $('#top-courses .owl-carousel').owlCarousel({
    loop: true,
    margin:10,
    nav:true,
    dots: true,
    responsive:{
      0:{
        items: 1,
        center: true
      },
      600:{
        items: 2,
        center: false
      },
      992: {
        items:3,
        center: false
      },
      1300: {
        items:4,
        center: false
      }
    }
  });
})
/**
 * Video Player Button
 */


/**
 * Accordion
 */
if (document.querySelectorAll(".accordion-button")) {
  const acBtns = document.querySelectorAll(".accordion-button")
  const chevrons = document.querySelectorAll(".bi-chevron-down")

  for (let i = 0; i < acBtns.length; i++) {
    acBtns[i].addEventListener("click", function () {
      if (itIsInArray("collapsed", acBtns[i].classList)) {
        chevrons[i].style.transform = "rotate(" + 360 + "deg)"
      } else {
        chevrons[i].style.transform = "rotate(" + 180 + "deg)"
      }
    }) 
  }
}

/**
 * Filter Bar Collapse
 */
if (document.querySelector(".filter-sidebar-btn")) {
  
  const filterBtn = document.querySelector(".filter-sidebar-btn")
  const filterBtnBg = document.querySelector(".filter-sidebar-btn-bg")
  const deptSideBg = document.querySelector(".department-sidebar")

  filterBtn.addEventListener("click", function () {
    if (itIsInArray("collapsed", deptSideBg.classList)) {
      deptSideBg.classList.remove("collapsed")
      filterBtn.style.backgroundColor = "#212529"
      filterBtnBg.style.backgroundColor = "#212529"
    } else {
      deptSideBg.classList.add("collapsed")
      filterBtn.style.backgroundColor = "black"
      filterBtnBg.style.backgroundColor = "black"
    }
  })
}

/**
 * Ajax form Sign up page
 * 
 */
if (document.querySelector("#addUser")) {
  const addUser = document.querySelector("#addUser")

  // console.log("yes it exists");

  addUser.addEventListener("click", addUserFunc)

  function addUserFunc(e) {
    e.preventDefault()

    $(".preloader-div").show();
    // Set vars for all the fields
    let firstname = $("#firstName").val()
    let lastname = $("#lastName").val()
    let username = $("#username").val()
    let email = $("#email").val()
    let password = $("#password").val()
    let confirm_password = $("#confirm_password").val()

    if (!validateForm(firstname, lastname, username, email, password, confirm_password)) {
      $(".preloader-div").hide();
      return false
    }

    $.ajax({
      url: "user/create.php",
      method: "post",
      data: {
        firstname: firstname,
        lastname: lastname,
        username: username,
        email: email,
        password: password,
        confirm_password: confirm_password
      },
      dataType: "text",
      success: function(response) {
        $("#users").html(response)
        $(".preloader-div").hide();
      }
    })
  }

  // Validate form func
  function validateForm(firstname, lastname, username, email, password, confirm_password) {
    //Set the flag
    let valid = true

    // Set default values for all the variables
    let firstnameErr = $("#firstNameErr").html("")
    let lastnameErr = $("#lastNameErr").html("")
    let usernameErr = $("#usernameErr").html("")
    let emailErr = $("#emailErr").html("")
    let passwordErr = $("#passwordErr").html("")
    let confirm_passwordErr = $("#confirm_passwordErr").html("")

    //Validate the fields
    if (firstname == "") {
        firstnameErr.html("* First name is required")
        valid = false
    }
    if (lastname == "") {
        lastnameErr.html("* Last name is required")
        valid = false
    }
    if (username == "") {
        usernameErr.html("* Username is required")
        valid = false
    }
    if (email == "") {
        emailErr.html("* Email is required")
        valid = false
    }
    if (password == "") {
        passwordErr.html("* Password is required")
        valid = false
    }
    if (confirm_password == "") {
        confirm_passwordErr.html("* Please you need to confirm password")
        valid = false
    }
    
    
    return valid
  }
}


/**
 * AJAX for the login page
 */
if (document.querySelector("#loginUser")) {
  const loginUser = document.querySelector("#loginUser")

  // console.log("Yes it exist");

  loginUser.addEventListener("click", loginUserFunc)

  function loginUserFunc(e) {
    e.preventDefault()

    $(".preloader-div").show();
    console.log("You are clicking me ");
    // Set vars for all the fields
    let email = $("#email").val()
    let password = $("#password").val()

    if (!validateForm(email, password)) {
      $(".preloader-div").hide();
      return false
    }

    $.ajax({
      url: "user/login.php",
      method: "post",
      data: {
        email: email,
        password: password
      },
      dataType: "text",
      success: function(response) {
        $("#users").html(response)
        $(".preloader-div").hide();
      }
    })
  }

  // Validate form func login
  function validateForm(email, password) {
    //Set the flag
    let valid = true

    // Set default values for all the variables
    let emailErr = $("#emailErr").html("")
    let passwordErr = $("#passwordErr").html("")

    //Validate the fields
    if (email == "") {
        emailErr.html("* Email is required")
        valid = false
    }
    if (password == "") {
        passwordErr.html("* Password is required")
        valid = false
    }

    return valid
  }
}

if (document.querySelector("#forgot-form")) {

  if (document.querySelector("#sendMail")) {
    const sendMail = document.querySelector("#sendMail")

    // console.log("send mail exists");

    sendMail.addEventListener("click", sendMailFunc)

    function sendMailFunc(e) {
      e.preventDefault()

      $(".preloader-div").show();
      // console.log("You are clicking me ");

      // Set vars for all the fields
      let email = $("#email").val()

      if (!validateEmail(email)) {
        $(".preloader-div").hide();
        return false
      }

      $.ajax({
        url: "user/forgotpwd.php",
        method: "post",
        data: {
          email: email
        },
        dataType: "text",
        success: function(response) {
          $("#users").html(response)
          $(".preloader-div").hide();
        }
      })
    }
  }
  
  if (document.querySelector("#checkOTP")) {
    const checkOTP = document.querySelector("#checkOTP")
    checkOTP.addEventListener("click", checkOTPFunc)

    console.log("checkotp exists");

    function checkOTPFunc(e) {
      e.preventDefault()

      $(".preloader-div").show();
      console.log("You are clicking me otp");

      // Set vars for all the fields
      let otp = $("#otp").val()

      if (!validateOTP(otp)) { 
        $(".preloader-div").hide();
        return false
      }

      $.ajax({
        url: "user/checkotp.php",
        method: "post",
        data: {
          otp: otp
        },
        dataType: "text",
        success: function(response) {
          $("#users").html(response)
          $(".preloader-div").hide();
        }
      })
    }
  }

  if (document.querySelector("#changePWD")) {
    const changePWD = document.querySelector("#changePWD")
    changePWD.addEventListener("click", changePWDFunc)

    function changePWDFunc(e) {
      e.preventDefault()

      $(".preloader-div").show();
      console.log("You are clicking me changepwd");

      // Set vars for all the fields
      let password = $("#password").val()
      let rptpassword = $("#rptpassword").val()

      if (!validatePWD(password, rptpassword)) { 
        $(".preloader-div").hide();
        return false
      }

      $.ajax({
        url: "user/changepwd.php",
        method: "post",
        data: {
          password: password,
          rptpassword: rptpassword
        },
        dataType: "text",
        success: function(response) {
          $("#users").html(response)
          $(".preloader-div").hide();
        }
      })
    }
  }

  

  // Validate email func 
  function validateEmail(email) {
    //Set the flag
    let valid = true

    // Set default values for the email variable
    let emailErr = $("#emailErr").html("")

    //Validate the fields
    if (email == "") {
        emailErr.html("* Email is required")
        valid = false
    }

    return valid
  }
  // Validate forgot pasword form to check if otp is correct
  function validateOTP(otp) {
    //Set the flag
    let valid = true

    // Set default values for all the variables
    let otpErr = $("#otpErr").html("")

    //Validate otp field
    if (otp == "") {
        otpErr.html("* OTP Code is required")
        valid = false
    }

    return valid
  }
  // Validate the password fields
  function validatePWD(password, rptpassword) {
    let valid = true

    // Set default values for all the variables
    let passwordErr = $("#passwordErr").html("")
    let rptpasswordErr = $("#rptpasswordErr").html("")

    //Validate all the fields
    if (password == "") {
      passwordErr.html("* New password is required")
      valid = false
    }

    if (rptpassword == "") {
      rptpasswordErr.html("* Repeat the password is confirm if your correct")
      valid = false
    }

    return valid
  }
}

