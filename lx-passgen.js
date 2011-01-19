function generatePassword() {
     
    var length=8;
    var pass = "";
    var special = false; 
    var digits = true;
    var lower = true;
    var upper = true;
    
    length = document.lxPassGenForm.length.value;
    
    if (!isNumber(length)) {
    	document.lxPassGenForm.length.focus();
    	return false;
    }
        
	special = Boolean(document.lxPassGenForm.special.checked);
	digits = Boolean(document.lxPassGenForm.digits.checked);
	lower = Boolean(document.lxPassGenForm.lower.checked);
	upper = Boolean(document.lxPassGenForm.upper.checked);


	var aSpecial = ",.:;_=";
	var aDigits = "0123456789";
	var aLower = "abcdefghijklmnopqrstuvwxyz";
	var aUpper = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	var aFull = "";
	
	
    if (lower) {
    	aFull = aFull + aLower; }
    if (upper) {
    	aFull = aFull + aUpper; }
    if (digits) {
    	aFull = aFull + aDigits; }
    if (special) {
    	aFull = aFull + aSpecial; }
    
    var fullLen = aFull.length;
    if (fullLen==0) {
    	document.lxPassGenForm.result.value = "Please select some options!";
    	document.lxPassGenForm.result.className = 'passgen-error';
    	setTimeout("document.lxPassGenForm.result.className = '';",2000);
    	return false;
    }
    
    for (i=0; i < length; i++) {
	    pass = pass + aFull[getRandom(fullLen)];
    }
 
    document.lxPassGenForm.result.value = pass;
 
    return true;
}

function checkLength() {
	obj = document.lxPassGenForm.length;
    if (!isNumber(obj.value)) {
    	obj.className = "passgen-error";
    	return false;
    }
    obj.className = "";
    return true;
}
 
function getRandom(max) { 
    var rnd = Math.random();
    rnd = parseInt(rnd * max);
    return rnd;
}


function pause(milliseconds) {
	var dt = new Date();
	while ((new Date()) - dt <= milliseconds) { /* Do nothing */ }
}


function isNumber(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}