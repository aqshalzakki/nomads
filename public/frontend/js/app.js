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


