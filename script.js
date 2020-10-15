document.addEventListener('click', function(eVe) {
	if(eVe.target.dataset.reset) {
		eVe.preventDefault();
		let form = eVe.target.parentNode.parentNode,
			targets = form.querySelectorAll(`input[type="${eVe.target.dataset.reset}"]`);
		targets.forEach(function(e) {
			e.value = null;
		});
	}
});