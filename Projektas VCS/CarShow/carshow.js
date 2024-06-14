let currentSlide = 0;
const slides = document.querySelectorAll('.slide');
const totalSlides = slides.length;

const firstName = document.getElementById('first-name');
const lastName = document.getElementById('last-name');
const email = document.getElementById('email');
const phoneNumber = document.getElementById('phone-number');
const carManufacturer = document.getElementById('car-manufacturer');
const carModel = document.getElementById('car-model');
const carBuildYear = document.getElementById('car-build-year');
const carEngineCapacity = document.getElementById('car-engine-capacity');
const carEnginePowerKw = document.getElementById('car-engine-power-kw');
const licensePlateNumber = document.getElementById('license-plate-number');
const carModifications = document.getElementById('car-modifications');
const successMessage = document.querySelector('.success-message');
const errorMessage = document.querySelector('.error-message');

document.getElementById('search-icon').addEventListener('click', function() {
    const query = document.getElementById('search-input').value;
    if (query) {
        alert('Searching for:' + query);
    } else {
        alert('Please enter a search term');
    }
});

const goToHomePage = () => {
    window.location.href = '/';
}

const showSlide = (index) => {
  if (index >= totalSlides -3) {
    currentSlide = 0;
  } else if (index < 0) {
    currentSlide = totalSlides / 2 - 1;
  } else {
    currentSlide = index;
  }

  const sliderWidth = document.querySelector('.slider').clientWidth;
  const newTransform = -currentSlide * (sliderWidth / 2);
  document.querySelector('.slides').style.transform = `translateX(${newTransform}px)`;
}

const nextSlide = () => {
  showSlide(currentSlide + 1);
}

const prevSlide = () => {
  showSlide(currentSlide - 1);
}

setInterval(nextSlide, 4000);

showSlide(currentSlide);

const updateTimer = () => {

  const targetDate = new Date("August 16, 2024 11:00:00").getTime();

  const now = new Date().getTime();


  const timeRemaining = targetDate - now;

  const days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
  const hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  const minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
  const seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);


  const timerElement = document.getElementById('timer');
  timerElement.innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";
}

setInterval(updateTimer, 1000);

updateTimer();

const showPage = (page) => {
    const pages = document.querySelectorAll('.pages');
    const registerPage = document.getElementById('register-page');
    const programPage = document.getElementById('program-page');
    const pastEventsPage = document.getElementById('past-events-page');
    const locationPage = document.getElementById('location-page');

    pages.forEach((page) => {
        page.classList.remove('show');
        page.classList.add('hide');
    });

    switch(page) {
        case 'register-page':
            registerPage.classList.remove('hide');
            registerPage.classList.add('show');
            break;
        case 'program-page':
            programPage.classList.remove('hide');
            programPage.classList.add('show');
            break;
        case 'past-events-page':
            pastEventsPage.classList.remove('hide');
            pastEventsPage.classList.add('show');
            break;
        case 'location-page':
            locationPage.classList.remove('hide');
            locationPage.classList.add('show');
            break;
    }
}

const submitForm = () => {
    const registerForm = document.getElementById('register-form');

    registerForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        errorMessage.classList.remove('show');
        successMessage.classList.remove('show');

        const payload = {
            first_name: firstName.value,
            last_name: lastName.value,
            email: email.value,
            phone_number: phoneNumber.value,
            car_manufacturer: carManufacturer.value,
            car_model: carModel.value,
            car_build_year: carBuildYear.value,
            car_engine_capacity: carEngineCapacity.value,
            car_engine_power_kw: carEnginePowerKw.value,
            license_plate_number: licensePlateNumber.value,
            car_modifications: carModifications.value,
        }

        try {
            const response = await fetch('/api/visitors', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(payload),
            });

            if (response.status === 500) {
                clearForm();
                errorMessage.classList.add('show');
                return;
            }
        } catch (e) {
            clearForm();
            errorMessage.classList.add('show');
            return;
        }

        clearForm();
        successMessage.classList.add('show');
    });
}

const clearForm = () => {
    firstName.value = '';
    lastName.value = '';
    email.value = '';
    phoneNumber.value = '';
    carManufacturer.value = '';
    carModel.value = '';
    carBuildYear.value = '';
    carEngineCapacity.value = '';
    carEnginePowerKw.value = '';
    licensePlateNumber.value = '';
    carModifications.value = '';
}

submitForm();
