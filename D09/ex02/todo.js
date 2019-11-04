var itemId = 0;
var listId = 0;

//  ITEM MANAGEMENT

function NewItem() {
    var addItem = prompt("Add to the TODO list", "New Item " + itemId);

    if (addItem != null) {
        var item = document.createElement("div");
        var list = document.getElementById('ft_list');
        
        item.setAttribute('id', itemId);
        item.setAttribute('onclick', "DeleteItem("+itemId+");");
        item.innerHTML = addItem;
        document.getElementById('ft_list').prepend(item);
        itemId++;
        setCookie('MyList', encodeURIComponent(list.innerHTML), 1);

    }
}

function DeleteItem(id) {
    var item = document.getElementById(id);
    var list = document.getElementById('ft_list');
    
    if (confirm("Are you sure you want to delete " + item.innerHTML + " from the list ?"))
        list.removeChild(item);
    setCookie('MyList', encodeURIComponent(list.innerHTML), 1);
}

// COOKIE MANAGEMENT 

function setCookie(name, value, expire) {
    var d = new Date();
	d.setTime(d.getTime() + (expire * 24 * 60 * 60 * 1000));
	var expires = "expires="+d.toUTCString();
    document.cookie = name + "=" + value + "; " + expires;
    console.log(document.cookie);
}

function getCookie(name) {
	var nom = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0; i<ca.length; i++)
	{
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1);
		if (c.indexOf(nom) == 0) return c.substring(nom.length,c.length);
	}
	return "";
}

function saveCookie() {
    var list = document.getElementById('ft_list');
    list.innerHTML = decodeURIComponent(getCookie('MyList'));
}
