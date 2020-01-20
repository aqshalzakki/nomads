// require('./bootstrap');

// window.Vue = require('vue');

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

// const app = new Vue({
//     el: '#app',
// });


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
	
	if (input)
	{
		input.addEventListener('change', preview)

		function preview()
		{
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