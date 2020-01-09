(function collapseMenu()
{

	const openMenus = document.querySelectorAll('.open-collapse-menu')

	openMenus.forEach(openMenu => {

		const trigger = openMenu.dataset.collapsetrigger
		const collapseMenu = document.querySelector(trigger)
		const menuHeight = collapseMenu.getBoundingClientRect().height

		// Set default height to 0
		collapseMenu.style.height = '0px'
		collapseMenu.style.overflow = 'hidden'

		openMenu.addEventListener('click', (e) => {

			e.preventDefault()

			if(collapseMenu.getBoundingClientRect().height == 0)
			{

				collapseMenu.style.height = menuHeight + 'px'

			}
			else
			{

				collapseMenu.style.height = '0px'

			}


		})

	})

})()