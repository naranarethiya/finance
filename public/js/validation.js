function chkmobile()
{
	var a = document.getElementById(cmobile).value;
	if(a=="")
	{
	alert("please Enter the Mobile Number");
	document.getElementById(cmobile).focus();
	return false;
	}
	if(isNaN(a))
	{
	alert("Enter the valid Mobile Number(Like : 9566137117)");
	document.getElementById(cmobile).focus();
	return false;
	}
	if((a.length < 1) || (a.length > 10))
	{
	alert(" Your Mobile Number must be 1 to 10 Integers");
	document.getElementById(cmobile).select();
	return false;
	}
}

function chkemail() 
{
    var x = document.getElementById(cemail).value;
    var atpos = x.indexOf("@");
    var dotpos = x.lastIndexOf(".");
    if (atpos< 1 || dotpos<atpos+2 || dotpos+2>=x.length) {
        alert("Not a valid e-mail address");
        return false;
    }
}