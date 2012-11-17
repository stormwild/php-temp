// odd numbers of 0 - 100

function showOddNumbers() {
	for(i = 0; i < 100; i++) {
		if(i % 2 != 0) {
			echo i;
		}	
	}
}

// 1 image mouseover show image 2


<img id="product" src="img1.jpg">

$("#product").onmouseover(function(){
	this.attr("src", "img2.jpg");
});

$("#product").onmouseout(function(){
	this.attr("src", "img1.jpg");
});

function getRow($id){
	$query = 'select * from product where id =' .  $id;
	return mysql->query($query); // returns $row object
}

function getChildren($id){
	$query = 'select * from product where pid =' . $id;
	return mysql->query($query); // returns array of child objects
}

function rec($id) {
	$row = getRow($id);	
	applyChanges($row);
	$children = getChildren($id);
	if(count($children) > 0){
		foreach($children as $child){		
			rec($child['id']);
		}
	}
}

