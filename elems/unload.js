	
	function handler() {	
		let promise = fetch('elems/unload.php');
		
		promise.then(
			response => {
				return response.text();
			}
		).then(
			text => {
				user_content.innerHTML=text;
			}
		).catch(error => console.error(error));
			
		
	 };	
	 
	 setInterval(handler, 500);