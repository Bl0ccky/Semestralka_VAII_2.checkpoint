const reg_form = document.getElementById('reg_form');
const edit_form = document.getElementById('edit_form');
const addTour_form = document.getElementById('addTour_form');
const name = document.getElementById('name');
const lastName = document.getElementById('lastName');
const date = document.getElementById('date');
const email = document.getElementById('email');
const login = document.getElementById('login');
const password = document.getElementById('password');
const price = document.getElementById('price');
const capacity = document.getElementById('capacity');

if(reg_form != null)
{
    reg_form.addEventListener('submit', (e) => {
        checkInputs(e);
    })
}
else if(edit_form !=null)
{
    edit_form.addEventListener('submit', (e) =>{
        checkInputs(e);
    })
}
else if(addTour_form !=null)
{
    addTour_form.addEventListener('submit', (e) =>{
        checkInputs(e);
    })
}


function checkInputs(e) {

    let nameValue;
    let lastNameValue;
    let emailValue;
    let loginValue;
    let passwordValue;
    let dateValue;
    let today;
    let validMinBirthDate;
    let validMinTourDate;
    let priceValue;
    let capacityValue;

    nameValue = name.value;
    dateValue = new Date(date.value);
    today = new Date();
    validMinBirthDate = new Date(
        today.getFullYear() - 18,
        today.getMonth(),
        today.getDate(),
        today.getHours(),
        today.getMinutes());

    validMinTourDate = new Date(
        today.getFullYear(),
        today.getMonth(),
        today.getDate() + 7,
        today.getHours(),
        today.getMinutes());

    //Validácia mena
    if (!nameValue.charAt(0).match(/^[A-Z]+$/))
    {
        setErrorFor(name, 'Prvý znak musí byť veľký!', e);
    }
    else if (!nameValue.match(/^[A-Za-z]+$/))
    {
        setErrorFor(name, 'Meno musí obsahovať len písmená!', e);
    }
    else
    {
        setSuccessFor(name);
    }


    //Validácia dátumu
    if(reg_form != null || edit_form != null)
    {
        if (dateValue > validMinBirthDate)
        {
            setErrorFor(date, 'Dátum musí byť aspoň 18 rokov starý!', e);
        }
        else
        {
            setSuccessFor(date);
        }
    }
    else if(addTour_form != null)
    {
        if (dateValue < validMinTourDate)
        {
            setErrorFor(date, 'Dátum musí byť najmenej týžden po dnešnom!', e);
        }
        else
        {
            setSuccessFor(date);
        }
    }

    if(reg_form != null || edit_form != null)
    {
        lastNameValue = lastName.value;
        emailValue = email.value;
        loginValue = login.value;
        passwordValue = password.value;

        //Validácia priezviska
        if (!lastNameValue.charAt(0).match(/^[A-Z]+$/))
        {
            setErrorFor(lastName, 'Prvý znak musí byť veľký!', e);
        }
        else if (!lastNameValue.match(/^[A-Za-z]+$/))
        {
            setErrorFor(lastName, 'Priezvisko musí obsahovať len písmená!', e);
        }
        else
        {
            setSuccessFor(lastName);
        }

        //Validácia emailu
        if(!isEmail(emailValue))
        {
            setErrorFor(email, 'Zlý formát emailu!', e);
        }
        else
        {
            setSuccessFor(email);
        }

        //Validácia loginu
        if (!loginValue.charAt(0).match(/^[A-Z]+$/))
        {
            setErrorFor(login, 'Prvý znak musí byť veľký!', e);
        }
        else
        {
            setSuccessFor(login);
        }

        //Validácia hesla
        if (passwordValue.length <= 6)
        {
            setErrorFor(password, 'Heslo musí mať aspoň 7 znakov!', e);
        }
        else
        {
            setSuccessFor(password);
        }


    }
    else if(addTour_form != null)
    {
        priceValue = price.value;
        capacityValue = capacity.value;

        //Validácia ceny
        if (priceValue < 100)
        {
            setErrorFor(price, 'Cena musí mať hodnotu aspoň 100€!', e);
        }
        else
        {
            setSuccessFor(price);
        }

        //Validácia kapacity
        if (capacityValue < 5)
        {
            setErrorFor(capacity, 'Kapacita je príliš nízka!', e);
        }
        else
        {
            setSuccessFor(capacity);
        }
    }





}

function setSuccessFor(input)
{
    let formInput = input.parentElement;
    let i = formInput.querySelector('i');
    let small = formInput.querySelector('small');
    if(reg_form != null)
    {
        small.className = 'visually-hidden oNasText';
        i.className = 'mt-2 oNasText fas fa-check-circle';
        formInput.className = 'mb-3 form_input success';
    }
    else if(edit_form != null)
    {
        small.className = 'visually-hidden oNasText';
        i.className = 'mt-2 oNasText2 fas fa-check-circle';
        formInput.className = 'col-sm-9 text-secondary form_input success';
    }

    else if(addTour_form != null)
    {
        small.className = 'visually-hidden oNasText';
        i.className = 'mt-2 oNasText fas fa-check-circle';
        formInput.className = 'mb-3 form_input success';
    }


}

function setErrorFor(input, message, e)
{
    let formInput = input.parentElement;
    let small = formInput.querySelector('small');
    let i = formInput.querySelector('i');

    if(reg_form != null)
    {
        e.preventDefault();
        small.className = 'oNasText';
        formInput.className = 'mb-3 form_input error';
        i.className = 'mt-2 oNasText fas fa-exclamation-circle';
        small.innerText = message;
    }
    else if(edit_form != null)
    {
        e.preventDefault();
        small.className = 'oNasText2';
        formInput.className = 'col-sm-9 text-secondary form_input error';
        i.className = 'mt-2 oNasText fas fa-exclamation-circle';
        small.innerText = message;
    }

    else if(addTour_form != null)
    {
        e.preventDefault();
        small.className = 'oNasText';
        formInput.className = 'mb-3 form_input error';
        i.className = 'mt-2 oNasText fas fa-exclamation-circle';
        small.innerText = message;
    }


}

function isEmail(email)
{
    return /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
}


