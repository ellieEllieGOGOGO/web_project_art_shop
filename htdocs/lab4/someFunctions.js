function addFavs (){
    alert("Item uccessfully added to your favorites");
}

function validateForm(){
    let userName = document.forms["logInForm"]["username"].value;
    let password = document.forms["logInForm"]["password"].value;
    if (userName == "" || password == "") {
        alert("Username & password must be filled out");
        return false;
    }
}

thisRow = function (id){
    let row = document.getElementById(id);
    row.remove();
}

function signUpValidate(){
    let userName = document.forms["signUpForm"]["username"].value;
    let password = document.forms["signUpForm"]["password"].value;
    let password_repeat = document.forms["signUpForm"]["pwd_repeat"].value;

    if (userName == "" || password == "" || password_repeat == ""){
        alert("Username & password must be filled out");
        return false;
    } else if(password != password_repeat){
        alert("passwords entered don't match each other, try again");
    } else {
        checkPassword(password);
    }
}

function checkPassword(){
    let p = document.forms["signUpForm"]["pw"].value,
        errors = [];
    if (p.length < 8) {
        errors.push("Your password must be at least 8 characters");
    }
    if (p.search(/[a-z]/i) < 0) {
        errors.push("Your password must contain at least one letter.");
    }
    if (p.search(/[0-9]/) < 0) {
        errors.push("Your password must contain at least one digit.");
    }
    if (errors.length > 0) {
        alert(errors.join("\n"));
        return false;
    }else{
        alert("successfully logged in!!");
    }
    return true;
}

var slideIndex = 1;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
    showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("dot");
    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";
    dots[slideIndex-1].className += " active";
}
