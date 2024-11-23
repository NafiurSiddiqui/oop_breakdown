class User {
	name = '';
	email = '';
	#bankBalance = 0;
	#password = '';

	constructor(name, email, bankBalance, password) {
		this.name = name;
		this.email = email;
		this.bankBalance = bankBalance;
		this.#password = password;
	}
}

const user = new User('Jenny', 'jen@xyz.com', 10000, 'secret');

console.log(user.bankBalance); // DOES NOT THROW ANY ERROR.
console.log(user.#bankBalance); //Throws runtime error.
