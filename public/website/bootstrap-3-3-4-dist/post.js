var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the crurrent tab

function showTab(n) {
    // This function will display the specified tab of the form...
    var x = document.getElementsByClassName("tab");
    x[n].style.display = "block";
    //... and fix the Previous/Next buttons:
    if (n == 0) {
        document.getElementById("prevBtn").style.display = "none";
        document.getElementById("submitBtn").style.display = "none";
        window.scrollTo({
            top: 0,
            left: 0,
            behavior: 'smooth'
        });
    } else {
        document.getElementById("prevBtn").style.display = "inline";
        window.scrollTo({
            top: 0,
            left: 0,
            behavior: 'smooth'
        });
    }
    if (n == (x.length - 1)) {
        //document.getElementById("nextBtn").innerHTML = "Submit";
        document.getElementById("nextBtn").style.display = "none";
        document.getElementById("submitBtn").style.display = "inline";
    }
    else {
        document.getElementById("nextBtn").innerHTML = "التالي";
        window.scrollTo({
            top: 100,
            left: 100,
            behavior: 'smooth'
        });
    }
    //... and run a function that will display the correct step indicator:
    fixStepIndicator(n)
}

function nextPrev(n) {
    // This function will figure out which tab to display
    var x = document.getElementsByClassName("tab");
    // Exit the function if any field in the current tab is invalid:
    if (n == 1 && !validateForm()) return false;
    // Hide the current tab:
    x[currentTab].style.display = "none";
    // Increase or decrease the current tab by 1:
    currentTab = currentTab + n;

    // if you have reached the end of the form...
    if (currentTab >= x.length) {
        // ... the form gets submitted:
        document.getElementById("regForm").submit();
        return false;
    }
    // Otherwise, display the correct tab:
    showTab(currentTab);
}

function getCheckedValue( groupName ) {

    var radios = document.getElementsByName( 'ctype' );
    for( i = 0; i < radios.length; i++ ) {
        if( radios[i].checked ) {
            return radios[i].value;
        }
    }
    return null;
}

function validateForm() {
    // This function deals with validation of the form fields
    var x, y, i, valid = true;
    x = document.getElementsByClassName("tab");

    y = x[currentTab].getElementsByTagName("input");

    // A loop that checks every input field in the current tab:
    z = x[currentTab].getElementsByTagName('select');

    for (i = 0; i < y.length; i++) {
        // If a field is empty...0
        if(y[i].type == "file"){

            continue;
        }
        else if(y[i].value == ""){

            // add an "invalid" class to the field:
            y[i].className += " invalid";
            // and set the current valid status to false
            valid = false;
        }

    }

    for (i = 0; i < z.length; i++) {
        // If a field is empty...0
        if(z[i].value == ""){
            // add an "invalid" class to the field:
            z[i].className += " invalid";
            // and set the current valid status to false
            valid = false;
        }

    }
    // If the valid status is true, mark the step as finished and valid:
    if (valid) {
        document.getElementsByClassName("step")[currentTab].className += " finish";
    }
    return valid; // return the valid status
}

function fixStepIndicator(n) {
    // This function removes the "active" class of all steps...
    var i, x = document.getElementsByClassName("step");
    for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
    }
    //... and adds the "active" class on the current step:
    x[n].className += " active";
}