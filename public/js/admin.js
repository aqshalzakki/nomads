const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

(function admin(){

    let menu = document.querySelectorAll('.side-menu .nav-link')

    if (menu)
	{
        const content = document.querySelector('.dynamic-content')

		menu.forEach(item => {

            console.log(item);

            item.addEventListener('click', e => {
 				e.preventDefault()
       			let urlRequest = item.getAttribute('href')

                // sintaks hoki
                if (window.location.href == urlRequest) return

                window.history.pushState("", "", urlRequest)

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
