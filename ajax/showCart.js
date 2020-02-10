var cart;
function showCart(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            cart = JSON.parse(this.responseText);
            generateTable();
        }
    };
    xhttp.open("GET", "./ajax/showCart.php", true);
    xhttp.send();
}

function generateTable(){
    document.getElementById("containerTable").innerHTML="";
    var divTable = document.getElementById("containerTable");
    var table = document.createElement('table');
    //table.border = '1';

    var tableHead = document.createElement('thead');
    table.appendChild(tableHead);
    var tr = document.createElement('tr');
    tableHead.appendChild(tr);
    var cabecera=['Quantity','Title','Price'];
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
    table.style.width="800px";

    var bookQuantity=0;
    var bookPrice=0;
    var total=0;

    cart.forEach(element => {
        var tr = document.createElement('tr');
        tableBody.appendChild(tr);

        var td = document.createElement('td');
        td.style.border="1px solid black";
        td.style.background="white";
        td.style.width="100px";

        var container = document.createElement('div');
        container.id = "containerCart";
        //container.style.width="200px";
        var buttons = document.createElement('div');
        buttons.id="buttonsCart";

        container.appendChild(buttons);

        var addProduct = document.createElement('button');
        addProduct.type = "button";
        addProduct.id = "addProduct";
        addProduct.name = "bAddProduct";
        addProduct.setAttribute("onclick","increaseProduct("+element.book_ID+","+element.member_ID+")");
        buttons.appendChild(addProduct);


        var removeProduct = document.createElement('button');
        removeProduct.type = "button";
        removeProduct.id = "removeProduct";
        removeProduct.name = "bRemoveProduct";
        removeProduct.setAttribute("onclick","decreaseProduct("+element.book_ID+","+element.member_ID+")");
        buttons.appendChild(removeProduct);

        var quantityProduct = document.createElement('p');
        quantityProduct.id="quantityProduct";
        quantityProduct.appendChild(document.createTextNode(element.quantity));
        bookQuantity = parseInt(element.quantity);
        container.appendChild(quantityProduct);
        td.appendChild(container);
        tr.appendChild(td);

        var title = document.createElement('td');
        title.style.textAlign='center';
        title.style.border="1px solid black";
        title.style.background="white";
        title.style.width="300px";
        title.appendChild(document.createTextNode(element.title.charAt(0).toUpperCase()+element.title.slice(1)));
        tr.appendChild(title)

        var price = document.createElement('td');
        price.style.textAlign='center';
        price.style.border="1px solid black";
        price.style.background="white";
        price.style.width="100px";
        //price.style.background='white';
        price.id="price";
        //getPrice(element.book_ID)
        price.appendChild(document.createTextNode(element.price));
        bookPrice = parseInt(element.price);
        tr.appendChild(price);

        total+=(bookQuantity*bookPrice);
    });
    var trTotal = document.createElement('tr');
    tableBody.appendChild(trTotal);

    var tdTotal1 = document.createElement('td');
    trTotal.appendChild(tdTotal1);
    var tdTotal2 = document.createElement('td');
    trTotal.appendChild(tdTotal2);
    var tdTotal3 = document.createElement('td');
    tdTotal3.id="totalPrice";
    tdTotal3.appendChild(document.createTextNode("TOTAL: "+total+"€"));
    tdTotal3.style.border="1px solid black";
    tdTotal3.style.background="white";
    trTotal.appendChild(tdTotal3);

    divTable.appendChild(table);
    var formButton = document.createElement('form');
    formButton.method="POST";
    var comprar = document.createElement('button');
    comprar.type="submit";
    comprar.id="bComprar";
    comprar.name="order_insert";
    comprar.value=cart[0].member_ID;
    comprar.innerHTML="Comprar";
    formButton.appendChild(comprar);
    divTable.appendChild(formButton);
}

function increaseProduct(book_ID,member_ID){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            showCart();
        }
    };
    xhttp.open("GET", "./ajax/increaseProduct.php?book_ID="+book_ID+"-"+member_ID, true);
    xhttp.send();
}

function decreaseProduct(book_ID,member_ID){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            showCart();
        }
    };
    xhttp.open("GET", "./ajax/decreaseProduct.php?book_ID="+book_ID+"-"+member_ID, true);
    xhttp.send();
}