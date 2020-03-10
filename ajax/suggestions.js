var availableTags;

function suggestion(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            availableTags=this.responseText.split("-");
            $("#author").autocomplete({
                source: availableTags
            });
        }
    };
    xhttp.open("GET", "./ajax/suggestions.php", true);
    xhttp.send();
}