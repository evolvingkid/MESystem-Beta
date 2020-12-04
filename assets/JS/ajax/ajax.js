
async function ajaxController(params,onFunctiondone) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            if (params.docID !== undefined) {
                document.getElementById(params.docID).innerHTML = this.responseText;
            }
            if (onFunctiondone !== undefined) {
                onFunctiondone(this.responseText);
            }
        }
    };
    xmlhttp.open("GET", params.url, true);
    xmlhttp.send();
    xmlhttp.onloadend = function () {
        return Promise.resolve(this.responseText);
    } 
}



