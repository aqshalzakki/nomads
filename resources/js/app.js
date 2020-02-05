// require('./bootstrap');

// window.Vue = require('vue');

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

// const app = new Vue({
//     el: '#app',
// });

const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

const baseUrl = "http://127.0.0.1:8000/";

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
					icon.classList.remove('fa-eye');
					icon.classList.add('fa-eye-slash');
				}
				else
				{
					passwordElement.setAttribute('type', 'password');
					icon.classList.add('fa-eye');
					icon.classList.remove('fa-eye-slash');
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

				categories.forEach(category => category.classList.remove('active'))

				category.classList.add('active')

				let urlRequest = this.lastElementChild.getAttribute('href')
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

(function profile(){

    let editProfile = document.querySelector('.user-edit')

    if (editProfile)
    {
    	let urlRequest = editProfile.getAttribute('href')
        let editable = [editProfile, document.querySelector('.user-img'), document.querySelector('.user-name')]
        let section = document.querySelector('section')
        let container = section.firstElementChild

        editable.forEach(edit => {

            edit.addEventListener('click', e => {
                event.preventDefault()

                // change section id
                section.id = 'profile'
                document.querySelector('title').innerHTML = 'Profile'

                window.history.pushState("", "", urlRequest)
                fetch(urlRequest, {
                    headers: {
                        'X-CSRF-TOKEN': csrf,
                        'Content-Type': 'application/json'
                    },
                })
                .then(res => res.text())
                .then(data => container.innerHTML = data)
            })

        })

    }

})();
