var gKeyStore = [];

$(document).keydown(function(e) {
	if(e.ctrlKey){
    	gKeyStore.push(e.key);
    }
});

$(document).keyup(function(e) {
    if (!e.ctrlKey) {
        if(gKeyStore.length > 0) { 
        	if(gKeyStore[1] == "s"){
        		$('.area-button').click();
        	}
	    	gKeyStore = [];
    	}
    }
});


