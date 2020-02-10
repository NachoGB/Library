function showTime(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        document.getElementById("clock").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "./ajax/showTime.php", true);
    xhttp.send();
}

setInterval(showTime);