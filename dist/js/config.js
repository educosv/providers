export const social_data = {
	apiKey: "AIzaSyDTivJmdeBZwqW3_KN_n9yBt4hMmJpjTso",
    authDomain: "appseduco.firebaseapp.com",
    projectId: "appseduco",
    storageBucket: "appseduco.appspot.com",
    messagingSenderId: "752777844306",
    appId: "1:752777844306:web:a66187c629e314f4edf18b",
    measurementId: "G-RR847YXVXW"
};

export const sweet = (res) => {
	if (res) {
		Swal.fire({
			icon: 'success',
			title: '😃 Usuario registrado!! 🥳',
			text: 'Ya puedes inicar tu sesión, gracias por registrarte.',
			confirmButtonText: `Genial! 👍`
		});
	}else {
		Swal.fire({
			icon: 'error',
			title: '😦 Usuario no registrado!! 😞',
			text: '¿Ya estas registrado con nosotros? intenta restablecer tu contraseña o verifica los datos y vuelve a intentarlo',
			confirmButtonText: `Ok! 👍`
		});
	}
}

export const log = (result) => {
	let arr_data = new FormData();
    let user = result.additionalUserInfo.profile;

    arr_data.append('firelogin', true);
    arr_data.append('email', user.mail);
    arr_data.append('name', user.displayName);
    arr_data.append('position', user.jobTitle);


    fetch('external_data', {
    	method: 'POST',
    	body: arr_data
    })
    .then(res => res.json())
    .then(data => {
    	if (data) {
    		location.reload();
    	}else {
    		Swal.fire({
				icon: 'error',
				title: '😦 Usuario no registrado!! 😞',
				text: '¿Ya estas registrado con nosotros? intenta restablecer tu contraseña o verifica los datos y vuelve a intentarlo',
				confirmButtonText: `Ok! 👍`
			});
    	}
    });
}

export const register = (result) => {
	let arr_data = new FormData();
    let user = result.user;

    arr_data.append('fireregister', true);
    arr_data.append('name', user.providerData[0].displayName);
    arr_data.append('email', user.providerData[0].email);

    fetch('external_data', {
    	method: 'POST',
    	body: arr_data
    })
    .then(res => res.json())
    .then(data => {
    	sweet(data);
    });
}

export const str_check = (str) => {
	if (str.length > 0) {
		let abc = 'ABCDEFGHIJKLMNÑOPQRSTUVWXYZabcdefghijklmnñopqrstuvwxyzáéíóúÁÉÍÓÚ1234567890 ';
		abc = abc.split('');
		str = str.split('');
		let res = true;
		for (var val in str) {
		    if (!abc.includes(str[val])) {
		    	res = false;
		    	break;
		    }
		}
		return res;
	}else {
		return false;
	}
}

export const number_check = (str) => {
	if (str.length > 0) {
		let abc = '1234567890 ';
		abc = abc.split('');
		str = str.split('');
		let res = true;
		for (var val in str) {
		    if (!abc.includes(str[val])) {
		    	res = false;
		    	break;
		    }
		}
		return res;
	}else {
		return false;
	}
}

export const prodservice_check = (str) => {
	if (str.length > 0) {
		let abc = 'ABCDEFGHIJKLMNÑOPQRSTUVWXYZabcdefghijklmnñopqrstuvwxyzáéíóúÁÉÍÓÚ1234567890,.-() ';
		abc = abc.split('');
		str = str.split('');
		let res = true;
		for (var val in str) {
		    if (!abc.includes(str[val])) {
		    	res = false;
		    	break;
		    }
		}
		return res;
	}else {
		return false;
	}
}

export const tel_check = (str) => {
	if (str.length > 0) {
		let abc = 'ABCDEFGHIJKLMNÑOPQRSTUVWXYZabcdefghijklmnñopqrstuvwxyzáéíóúÁÉÍÓÚ1234567890- ';
		abc = abc.split('');
		str = str.split('');
		let res = true;
		for (var val in str) {
		    if (!abc.includes(str[val])) {
		    	res = false;
		    	break;
		    }
		}
		return res;
	}else {
		return false;
	}
}

export const website_check = (str) => {
	if (str.length > 0) {
		let abc = 'ABCDEFGHIJKLMNÑOPQRSTUVWXYZabcdefghijklmnñopqrstuvwxyzáéíóúÁÉÍÓÚ1234567890.-_ ';
		abc = abc.split('');
		str = str.split('');
		let res = true;
		for (var val in str) {
		    if (!abc.includes(str[val])) {
		    	res = false;
		    	break;
		    }
		}
		return res;
	}else {
		return false;
	}
}

export const mail_check = (email) => {
	if (email.length > 0) {
		let abc = 'ABCDEFGHIJKLMNÑOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890_.-@';
		abc = abc.split('');
		let mail = email.split('');

		let res = true;

		for (var val in mail) {
		    if (!abc.includes(mail[val])) {
		    	res = false;
		    	break;
		    }
		}

		if (res) {
			let arroba = email.indexOf("@");
			if (arroba != -1)
			{
				let dominio = email.substring(email.length,(arroba+1));
				let punto = dominio.indexOf(".");
				return (punto != -1) ? true : false;
			}else {
				return false;
			}
		}else {
			return false;
		}
	}else {
		return false;
	}
}