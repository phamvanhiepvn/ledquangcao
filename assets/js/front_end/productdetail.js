
function getXMLHTTPs() { //fuction to return the xml http object
    var xmlhttp = false;
    try {
        xmlhttp = new XMLHttpRequest();
    }
    catch (e) {
        try {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        catch (e) {
            try {
                xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
            }
            catch (e1) {
                xmlhttp = false;
            }
        }
    }

    return xmlhttp;
}
function view_cart() {
    var baseurl = $("#baseurl").val();
    var strURL = baseurl + "shoppingcart/view_cart";
    var req = getXMLHTTPs();
    if (req) {
        req.onreadystatechange = function () {
            if (req.readyState == 4) {
                // only if "OK"
                if (req.status == 200) {

                    document.getElementById('view_cart_site').innerHTML = req.responseText;
                    document.getElementById('view_cart_sites').innerHTML = req.responseText;

                } else {
                    alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                }
            }
        }
        req.open("GET", strURL, true);
        req.send(null);
    }
}
