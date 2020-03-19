const devKey="vpJKhzzQsy4tuKkAxQAox19lHrQmJeqW";
var cityKey="";

function cityName(ciudad){
    fetch("http://dataservice.accuweather.com/locations/v1/cities/search?apikey="+devKey+"&q="+ciudad
    
    ).then(function(res){
        return res.json();
    })
    .then(function(res){
        cityKey=res[0].Key;
        weather(ciudad);
    })
    .catch(function(error) {
        console.log('Error:' + error.message);
    });
}

function weather(ciudad){
    fetch("http://dataservice.accuweather.com/currentconditions/v1/"+cityKey+"?apikey="+devKey
    
    ).then(function(res){
        return res.json();
    })
    .then(function(res){
        document.getElementById("content").innerHTML="";
        var content = document.getElementById("content");
        var div = document.createElement('div');
        div.id="containerTable";
        content.appendChild(div);
        
        var divTable = document.getElementById("containerTable");
        var table = document.createElement('table');

        var tableHead = document.createElement('thead');
        table.appendChild(tableHead);
        var tr = document.createElement('tr');
        tableHead.appendChild(tr);
        var cabecera=['Name','CityKey','Weather','DayTime','Temperature'];
        for(var i=0;i<cabecera.length;i++){
            var td = document.createElement('td');
            td.style.fontWeight='bold';
            td.style.textAlign='center';
            td.style.background='lightgrey';
            td.style.border="1px solid black";
            td.appendChild(document.createTextNode(cabecera[i]));
            tr.appendChild(td);
        }
        var tableBody = document.createElement('tbody');
        table.appendChild(tableBody);
        var tr=document.createElement("tr");
        tableBody.appendChild(tr);
        var tdName=document.createElement("td");
        tdName.style.textAlign='center';
        tdName.style.border="1px solid black";
        tdName.style.background="white";
        tdName.appendChild(document.createTextNode(ciudad));
        tr.appendChild(tdName);
        var tdCityKey=document.createElement("td");
        tdCityKey.style.textAlign='center';
        tdCityKey.style.border="1px solid black";
        tdCityKey.style.background="white";
        tdCityKey.appendChild(document.createTextNode(cityKey));
        tr.appendChild(tdCityKey);
        var tdWeather=document.createElement("td");
        tdWeather.style.textAlign='center';
        tdWeather.style.border="1px solid black";
        tdWeather.style.background="white";
        tdWeather.appendChild(document.createTextNode(res[0].WeatherText));
        tr.appendChild(tdWeather);
        var tdDayTime=document.createElement("td");
        tdDayTime.style.textAlign='center';
        tdDayTime.style.border="1px solid black";
        tdDayTime.style.background="white";
        if(res[0].IsDayTime){
            tdDayTime.appendChild(document.createTextNode("Day"));
        }else{
            tdDayTime.appendChild(document.createTextNode("Night"));
        }
        tr.appendChild(tdDayTime);
        var tdTemp=document.createElement("td");
        tdTemp.style.textAlign='center';
        tdTemp.style.border="1px solid black";
        tdTemp.style.background="white";
        tdTemp.appendChild(document.createTextNode(res[0].Temperature.Metric.Value+res[0].Temperature.Metric.Unit));
        tr.appendChild(tdTemp);

        divTable.appendChild(table);
    })
    .catch(function(error) {
        console.log('Error:' + error.message);
    });
}