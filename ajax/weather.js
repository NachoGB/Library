const devKey="vpJKhzzQsy4tuKkAxQAox19lHrQmJeqW";
const cityKey="305482";//Maó

function weather(){
    fetch("http://dataservice.accuweather.com/currentconditions/v1/"+cityKey+"?apikey="+devKey
    
    ).then(function(res){
        return res.json();
    })
    .then(function(res){
        console.log(res[0]);
    })
    .catch(function(error) {
        console.log('Error:' + error.message);
    });
}