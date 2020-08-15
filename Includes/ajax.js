function Suggestion(str){
    if(str.length<0){
        document.getElementById('output').innerHTML='';
    } else {
        var xmlhttp= new XMLHttpRequest();
        xmlhttp.onreadystatechange = function {
            if(xmlhttp.readyState==4 && xmlhttp.status==200){
                document.getElementById('output')=this.responseText;
            }
        }
        xmlhttp.open('GET','blog.php?pretraga='+str);
        xmlhttp.send();
    }
}