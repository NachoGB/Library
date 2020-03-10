function addLocalStorage(book_ID){
    if(localStorage.getItem("books")==null){
        localStorage.setItem("books",book_ID);
    }else{
        var info = localStorage.getItem("books");
        localStorage.setItem("books",info+"-"+book_ID);
    }
}