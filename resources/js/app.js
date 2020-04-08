const csrf    = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const baseUrl = "http://localhost:3000/";

// ishan.js
(function collapseMenu()
{

	const openMenus = document.querySelectorAll('.open-collapse-menu')

	openMenus.forEach(openMenu => {

		const trigger = openMenu.dataset.collapsetrigger
		const collapseMenu = document.querySelector(trigger)
		const menuHeight = collapseMenu.getBoundingClientRect().height
		const icon = openMenu.lastElementChild;


		// Set default height to 0
		collapseMenu.style.height = menuHeight + 'px'
		collapseMenu.style.overflow = 'hidden'


		openMenu.addEventListener('click', (e) => {

			e.preventDefault()

			if(collapseMenu.getBoundingClientRect().height == 0)
			{

				collapseMenu.style.height = menuHeight + 'px'
				icon.style.transform = 'rotate(0deg)'

			}
			else
			{

				collapseMenu.style.height = '0px'
				icon.style.transform = 'rotate(-180deg)'

			}


		})

	})

})();

// Preview image
(function previewImage(){
	let input = document.querySelector('.file-input')

	if (input){

		input.addEventListener('change', preview)

		function preview(){
			let fileObject = this.files[0];
			let fileReader = new FileReader();

			fileReader.readAsDataURL(fileObject);
			fileReader.onload = () => {
				let result = fileReader.result;
				let img = document.querySelector('#imageField');

				img.setAttribute('src', result)
			}

			document.querySelector('#fileName')
				    .innerHTML = 'Picture Selected.';
		}
	}
})();

// -----------------

(function seePassword(){

	const toggler = document.querySelectorAll('button[data-passwordtarget]');

	if(toggler)
	{
		toggler.forEach(toggle => {

			toggle.addEventListener('click', e => {

				e.preventDefault();

				const target = toggle.dataset.passwordtarget;

				const passwordElement = document.querySelector(target);

				const passwordElementType = passwordElement.getAttribute('type');

				const icon = toggle.querySelector('i');

				if(passwordElementType == 'password')
				{
					passwordElement.setAttribute('type', 'text');
					icon.classList.add('fa-eye');
					icon.classList.remove('fa-eye-slash');
				}
				else
				{
					passwordElement.setAttribute('type', 'password');
					icon.classList.remove('fa-eye');
					icon.classList.add('fa-eye-slash');
				}

			});

		})
	}

})();

(function checkPassword(){

	const formPassword = document.querySelector('[data-urlcheckpassword]');

	if(formPassword)
	{
		const currentPassword = formPassword.querySelector('#currentPassword');
		const newPassword = formPassword.querySelector('#newPassword');
		const repeatPassword = formPassword.querySelector('#repeatPassword');
		const btnChange = formPassword.querySelector('#btnChangePass');

		const error = formPassword.querySelector('#error')

		btnChange.classList.add('disabled');

		currentPassword.addEventListener('blur', async() => {

			const currentPasswordVal = currentPassword.value;

			const data = await matchPassword(currentPasswordVal, csrf);

			if(data.status)
			{

				error.innerHTML = '';

			}
			else
			{

				error.innerHTML = `<small class="text-danger ml-2">${data.message}</small>`;

			}

		});

		repeatPassword.addEventListener('keyup', () => {

			if(currentPassword.value !== '' && newPassword.value !== '' && repeatPassword.value !=='')
			{
				if(btnChange.classList.contains('disabled')) btnChange.classList.remove('disabled');
				btnChange.type = 'submit';
			}
			else
			{
				if(!btnChange.classList.contains('disabled')) btnChange.classList.add('disabled');
				btnChange.type = 'button';
			}

		});

	}


	function matchPassword(currentPassword, csrf){

		return fetch(baseUrl + 'profile/password/check', {
			method: 'post',
			headers: {
				'Content-Type' : 'application/json',
		        'X-CSRF-TOKEN': csrf
		    },
		    body: JSON.stringify({ currentPassword })

		}).then(res => res.json())
		  .then(res => res)

	}


})();

(function travelPackage(){

	let searchForm = document.querySelector('.search-package');
	if (searchForm)
	{
		let searchUrl = searchForm.getAttribute('action')
		let cardRoot = document.querySelector('.card-root')

		// categories
		let categories = document.querySelectorAll('.category')
		let categoryType = document.querySelector('.category-type')

		// Search input
		searchForm.addEventListener('submit', async(e) => {
			e.preventDefault()

			// get keyword
			let keyword = document.querySelector('#keyword').value

			// change url
			window.history.pushState("", "", searchUrl + "?keyword=" + keyword);

			// change title category
			categoryType.innerHTML = 'All'

			// await for data
			const data = await searchTravelPackage(keyword, searchUrl)

			// apply it to card root
			cardRoot.innerHTML = data
		})

		function searchTravelPackage(keyword, searchUrl){
			return fetch(searchUrl+ "?keyword=" +keyword, {
					headers : { 'X-CSRF-TOKEN': csrf, 'Content-Type': 'application/json'},
				})
				.then(res => res.text())
				.then(data => data)
				.catch(exception => console.log(exception))
		}

		categories.forEach(category => {

			category.addEventListener('click', function(el){
				el.preventDefault()

				let urlRequest = this.lastElementChild.getAttribute('href')

				// sintaks hoki
				if (window.location.href == urlRequest) return

				categories.forEach(category => category.classList.remove('active'))

				category.classList.add('active')

				categoryType.innerHTML = this.dataset.value

				// change url
				window.history.pushState("", "", urlRequest);

				// perform a http request
				fetch(urlRequest, {
					headers: {'X-CSRF-TOKEN' : csrf, 'Content-Type' : 'application/json'},
				})
				.then(res => res.text())
				.then(data => cardRoot.innerHTML = data)
				.catch(exception => console.log(exception))
			})
		})
	}
})();

(function nomadsModal(){

	const modalTogglers = document.querySelectorAll('[data-nmodal]');

	if(modalTogglers)
	{
		modalTogglers.forEach(toggler => {

			toggler.addEventListener('click', e => {

				e.preventDefault();

				const modalTarget = toggler.dataset.nmodal;

				document.querySelector('.nomads-modal' + modalTarget).classList.add('active');

			})

		})
	}

	// Close Modal
	const nomadsModals = document.querySelectorAll('.nomads-modal');

	nomadsModals.forEach(modal => {

		modal.querySelectorAll('[data-close]').forEach(close => {

			close.addEventListener('click', e => {

				e.preventDefault();

				if(close.dataset.close == 'true')
				{

					modal.classList.remove('active');

				}

			})

		})

	})

})();


(function numberOnly(){

	const magicNumberInputs = document.querySelectorAll('#magicNumberInputs input');

	if(magicNumberInputs)
	{
		magicNumberInputs.forEach(input => {

			input.addEventListener('keyup', e => {

			    input.value = input.value.slice(0, 1);

			})

		});
	}


})();

(function updateProfile(){
	const form = document.getElementById('profileForm')

	if (form){
		let messageContainer = document.getElementById('message') 

		const oldEmail 		 	= form.querySelector('#email').value
		const oldPhoneNumber    = form.querySelector('#nomor-hp').value

		const phoneNumberModal  = document.querySelector('#verifyPhone')
		const emailModal		= document.getElementById('emailSent')
		
		const modalTitle	 	= document.querySelector('h4.title')
		const modalMessage	 	= document.querySelector('p.message')
		const modalConfirmation = document.getElementById('confirmation')

		form.addEventListener('submit', e => {
			e.preventDefault()

			messageContainer.style.display = 'none'

			let data = {
                // image         : form.querySelector('input[name=image]').files[0],
				name 		  : form.querySelector('#nama').value,
				date_of_birth : form.querySelector('#datePicker').value,
				gender        : form.querySelector('input[type=radio]:checked').value || 'Lainnya',
				email 		  : form.querySelector('#email').value,
				phone_number  : form.querySelector('#nomor-hp').value,
				_method		  : 'PATCH'
            }

			fetch(form.action, {
				method: data._method,
				headers: {
					'Content-Type' : 'application/json',
			        'Accept'	   : 'application/json',
			        'X-CSRF-TOKEN' : csrf,
			    },
			    body: JSON.stringify(data)
			})
			.then(res => res.json())
			.then(res => {
				if (res.status == 204)
				{
					// change input name
					document.getElementById('userName').innerHTML = data.name
					messageContainer.style.display = 'block'
					messageContainer.classList.add('alert', 'alert-primary')
					messageContainer.innerHTML = res.message

					// set email verification status
					if (oldEmail != data.email && oldPhoneNumber != data.phone_number)
					{
						document.getElementById('emailStatus').innerHTML = 'Tidak Terverifikasi'
						emailModal.classList.add('active')

						const modalCloses = emailModal.querySelectorAll('[data-close]');

						modalCloses.forEach(close => {

							close.addEventListener('click', e => {

								setTimeout(() => {

									phoneNumberModal.classList.add('active')

								}, 500)

							})

						})
					} else if(oldEmail != data.email) {

						document.getElementById('emailStatus').innerHTML = 'Tidak Terverifikasi'
						emailModal.classList.add('active')						

						setInterval(async () =>{
							console.log('interval dijalankan!')
							if (await hasVerifiedEmail()){
								const status = (await hasVerifiedEmail()).status

								if (status !== null){
									document.location.href = baseUrl + '/profile'
									return
								}
							}
						}, 2000)

					}else if(oldPhoneNumber != data.phone_number){
						// check if user was updated a phone number
						// show modal
						phoneNumberModal.classList.add('active')
					}

				}else{
					if (res.errors){
						let errorsContainer = document.querySelector('#errors')
						let errorAlert 		= document.createElement('div')
						errorAlert.className = "alert alert-danger"
						let list     		= document.createElement('ul')

						res.errors.name ? list.innerHTML += `<li>${res.errors.name[0]}</li>` : ''
						res.errors.date_of_birth ? list.innerHTML += `<li>${res.errors.date_of_birth[0]}</li>` : ''
						res.errors.gender ? list.innerHTML += `<li>${res.errors.gender[0]}</li>` : ''
						res.errors.email ? list.innerHTML += `<li>${res.errors.email[0]}</li>` : ''
						res.errors.phone_number ? list.innerHTML += `<li>${res.errors.phone_number[0]}</li>` : ''
						res.errors.image ? list.innerHTML += `<li>${res.errors.image[0]}</li>` : ''

						errorAlert.append(list);


						// append
						errorsContainer.append(errorAlert);	
					}
				}

			})
			.catch(e => console.log(e))
		})

		let requestEmailForm = document.getElementById('requestEmail')
		let verifyEmail   	 = document.getElementById('verifyEmail')

		if (verifyEmail){
			verifyEmail.addEventListener('click', e => {
				emailModal.classList.toggle('active')

				modalTitle.innerHTML   		= 'Email is already sent!'
				modalMessage.innerHTML 		= 'Please check your email for verification.'
				modalConfirmation.innerHTML	= 'Oke'

			})
			requestEmailForm.addEventListener('submit', e => {
				e.preventDefault()

				fetch(requestEmailForm.action, {
					method: 'post',
					headers: {
						'X-CSRF-TOKEN' 	: csrf,
						'Content-Type'	: 'application/json',
						'Accept'		: 'application/json'
					},
				})
				.then(res => res.json())
				.then(res => {

					modalTitle.innerHTML = res.title
					modalMessage.innerHTML = res.message

					requestEmailForm.style.display = 'none'
					setInterval(async () =>{
					if (await hasVerifiedEmail()){
							const status = (await hasVerifiedEmail()).status

							if (status !== null){
								document.location.href = baseUrl + '/profile'
								return
							}
						}
					}, 2000)
				})
				.catch(er => console.log(er))
			})
		}
	}

	async function hasVerifiedEmail()
	{
		const wait = await fetch(baseUrl + 'profile/hasVerifiedEmail', {
			method: 'post',
			headers: {
				'X-CSRF-TOKEN' : csrf,
				'Content-Type' : 'application/json'
			}
		})

		const data = await wait.json()
	
		return data
	}

})();

