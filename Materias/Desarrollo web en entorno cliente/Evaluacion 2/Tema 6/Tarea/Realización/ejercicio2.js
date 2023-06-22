document.addEventListener("DOMContentLoaded", () => {
	/*-- Crea un contenedor --*/
	const container = document.createElement("div");
	container.className = "container";
	document.body.append(container);

	/*-- Crea el div que contendrá el numpad --*/
	const numpad = document.createElement("div");
	numpad.className = "numpad";
	container.append(numpad);

	/*-- Crea un div para mostrar mensajes --*/
	const messageDiv = document.createElement("div");
	container.append(messageDiv);

	// Crea el campo para visualizar los caracteres ocultos
	const passwordField = document.createElement("input");
	passwordField.type = "password";
	passwordField.value = "";
	passwordField.disabled = true;
	// passwordField.style.width = "50px";
	numpad.append(passwordField);

	// Crea un array con los números del 0 al 9
	const numbers = [1, 2, 3, 4, 5, 6, 7, 8, 9];

	// Baraja el array de números de forma aleatoria
	for (let i = numbers.length - 1; i > 0; i--) {
		const j = Math.floor(Math.random() * (i + 1));
		[numbers[i], numbers[j]] = [numbers[j], numbers[i]];
	}

	// Crea los botones de números
	for (let i = 0; i < numbers.length; i++) {
		const button = document.createElement("button");
		button.innerText = numbers[i];
		button.className = "numericButton";
		button.addEventListener("click", () => {
			passwordField.value += button.innerText;
		});
		numpad.append(button);
	}

	// Crea el botón 'C'
	const clearButton = document.createElement("button");
	clearButton.id = "clearButton";
	clearButton.innerText = "C";
	clearButton.addEventListener("click", () => {
		passwordField.value = passwordField.value.slice(0, -1);
	});
	numpad.append(clearButton);

	// Crea el botón 'Validar'
	const validateButton = document.createElement("button");
	validateButton.id = "validateButton";
	validateButton.className = "col-2 pad-0";
	validateButton.innerText = "VALIDAR";
	validateButton.addEventListener("click", () => {
		// Verifica si la contraseña es correcta
		const passwordPattern = /^\d{4}$/;
		if (!passwordPattern.test(passwordField.value)) {
			messageDiv.className = "rojo";
			messageDiv.innerText = "La clave debe ser un número de 4 dígitos.";
			return;
		}
		if (passwordField.value === "9999") {
			messageDiv.className = "verde";
			messageDiv.innerText = "Clave correcta.";
		} else {
			messageDiv.className = "rojo";
			messageDiv.innerText = "Clave incorrecta.";
		}
	});
	numpad.append(validateButton);
});