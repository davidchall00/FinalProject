//Function to remove all children from an element on page
function vRemoveAllChildren(eltParent) {
    while (eltParent.lastChild !== null) {
        eltParent.removeChild(eltParent.lastChild);
    }
}

function vDoAjax(strURL, strQueryString, fcnHandleResponse) {
    var objXHReq = new XMLHttpRequest();
    // tell ajax to send POST request for "Ajax.php" and to work asynchronously
    objXHReq.open("POST", strURL, true);
    // tell the server that we are sending a URL encoded query string
    objXHReq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // tell the XMLHttp object what function will handle response from server
    objXHReq.onreadystatechange = fcnHandleResponse;
    // set up is complete, send request
    objXHReq.send(strQueryString);
}

// Use Ajax to update the movie information in the MovieInfo section when the 
// selection in the ddl is changed. The parameter is the reference to the 
// <select> element
function vGetMovies(eltSelect) {
    // Get Movie ID from the select element
    var strMovieID = eltSelect.value;
    // construct query string to pass the author ID to the server
    var strQueryString = "function=GetMovies&movieID=" + strMovieID;
    var strQueryStringCast = "function=GetCast&movieID=" + strMovieID;
    var strQueryStringDirect = "function=GetDirector&movieID=" + strMovieID;
    var strQueryStringProduce = "function=GetProducer&movieID=" + strMovieID;
    // set up ajax and send request
    var strURL = "Ajax.php";
    vDoAjax(strURL, strQueryString, vDisplayMovieInfo);
    vDoAjax(strURL, strQueryStringCast, vDisplayCast);
    vDoAjax(strURL, strQueryStringDirect, vDisplayDirect);
    vDoAjax(strURL, strQueryStringProduce, vDisplayProducer);
}

// Function to display the movie info returned by the server when a new movie is
// selected from the ddl
function vDisplayMovieInfo() {
    if (this.readyState === 4) {
        if (this.status === 200) {
            var eltTBody = document.getElementById("tbyMovieInfo");
            vRemoveAllChildren(eltTBody);
            eltTBody.innerHTML = this.responseText;
        }
    }
}

function  vDisplayCast() {
    if (this.readyState === 4) {
        if (this.status === 200) {
            var eltTBody = document.getElementById("tbyCast");
            vRemoveAllChildren(eltTBody);
            eltTBody.innerHTML = this.responseText;
        }
    }
}

function  vDisplayDirect() {
    if (this.readyState === 4) {
        if (this.status === 200) {
            var eltTBody = document.getElementById("tbyDirector");
            vRemoveAllChildren(eltTBody);
            eltTBody.innerHTML = this.responseText;
        }
    }
}

function  vDisplayProducer() {
    if (this.readyState === 4) {
        if (this.status === 200) {
            var eltTBody = document.getElementById("tbyProducer");
            vRemoveAllChildren(eltTBody);
            eltTBody.innerHTML = this.responseText;
        }
    }
}
