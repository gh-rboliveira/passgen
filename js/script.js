var generateButton = document.getElementById('generate');
var copyButton = document.getElementById('copy');

generateButton.addEventListener("click", function (ev) {
    ev.preventDefault();

    //Clean elements
    copyButton.innerHTML = "Copy to Clipboard";
    var error_section = document.getElementById('errors');
    error_section.innerHTML = "";

    //Grab variables
    var length = document.getElementById('length').value;
    var uppercase = document.getElementById('uppercase').checked;
    var lowercase = document.getElementById('lowercase').checked;
    var numbers = document.getElementById('numbers').checked;
    var symbols = document.getElementById('symbols').checked;

    var pass_container = document.getElementById('password-container');
    var strength_container = document.getElementById('strength-indicator');

    //Make call to generate.php
    xhr = new XMLHttpRequest();
    xhr.open('POST', 'generate.php');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
    xhr.onload = function () {
        if (xhr.status === 200) {
            /*
             * SUCCESS responseText format
             * {"password":"xxx","strength":5}
             */
            var answer = JSON.parse(xhr.responseText);

            pass_container.innerHTML = answer.password;
            strength_container.innerHTML = answer.strength;
            strength_container.removeAttribute("class"); //remove all

            strength_container.classList.add('strength'+ answer.strength);
        }
        else if (xhr.status !== 200) {
            /*
             * responseText format
             * {"error_msg":"The reason why we had an error"}
             */
            var error = JSON.parse(xhr.responseText);
            error_section.innerHTML = error.error_msg;
        }
    };

    //Build query string
    var queryStr = "length=" + length;
    queryStr += "&uppercase=" + uppercase;
    queryStr += "&lowercase=" + lowercase;
    queryStr += "&numbers=" + numbers;
    queryStr += "&symbols=" + symbols;
    
    //Send request
    xhr.send(queryStr);
});

copyButton.addEventListener("click", function (ev) {
    ev.preventDefault();
    //Grab our password
    var pass = document.getElementById('password-container').innerHTML;
    
    //Create our input
    var input = document.createElement("input");
    input.setAttribute('id','input_to_destroy');
    input.setAttribute('type', 'text');
    input.setAttribute('class','hidden');
    input.setAttribute('value', pass);
    
    //Append to our body
    document.body.appendChild(input);

    //Select and copy
    input.select();
    document.execCommand("Copy");

    //Destroy element
    document.body.removeChild(input);

    this.innerHTML = "Copied!"
    

});

