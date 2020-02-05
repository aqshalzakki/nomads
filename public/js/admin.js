const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

(function admin(){

	const content = document.querySelector('.dynamic-content')

	if (content)
	{
		let menu = document.querySelectorAll('.side-menu .nav-link')

		menu.forEach(item => {
			
			item.addEventListener('click', e => {
 				e.preventDefault()

       			let urlRequest = item.getAttribute('href')

       			fetch(urlRequest, {
       				headers: {
						'Content-Type' : 'application/json',
				        'X-CSRF-TOKEN': csrf
				    },
       			})
       			.then(res => res.text())
       			.then(data => content.innerHTML = data)
			})
		})
	}

})();