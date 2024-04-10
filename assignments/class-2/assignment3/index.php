<fieldset>
    <legend>Hotel PHP + SPA - Rezerwacja pobytu</legend>
    <form action="./summary.php" method="post">
        <fieldset>
            <legend>Dane rezerwującego</legend>
            <label for="name">Imię:</label>
            <input type="text" name="name" id="name" required>
            <br />
            <label for="surname">Nazwisko:</label>
            <input type="text" name="surname" id="surname" required>
            <br />
            <label for="address">Adres:</label>
            <input type="text" name="address" id="address" required>
            <br />
            <label for="email">E-mail:</label>
            <input type="email" name="email" id="email" required>
            <br />
        </fieldset>
        <br />

        <fieldset>
            <legend>Dane karty kredytowej</legend>
            <label for="card_number">Numer karty:</label>
            <input type="text" name="card_number" id="card_number" required>
            <br />
            <label for="card_date">Data ważności:</label>
            <input type="date" name="card_date" id="card_date" required>
            <br />
            <label for="card_cvc">CVC:</label>
            <input type="text" name="card_cvc" id="card_cvc" required>
        </fieldset>
        <br />

        <fieldset>
            <legend>Rezerwacja</legend>
            <label for="people">Ilość osób:</label>
            <input type="number" name="people" id="people" min="1" max="4" value="1" required>
            <br />
            <label for="stay_date">Data pobytu:</label>
            <input type="date" name="stay_date" id="stay_date" required>
            <br />
            <label for="stay_days">Ilość dni pobytu:</label>
            <input type="number" name="stay_days" id="stay_days" min="1" required>
            <br />
            <label for="arrival_time">Godzina przyjazdu:</label>
            <input type="time" name="arrival_time" id="arrival_time" required>
            <br />
        </fieldset>
        <br />

        <fieldset id="guests">
            <legend>Dane Gości</legend>
            <fieldset>
                <legend>Gość </legend>
                <label for="guest_name">Imię:</label>
                <input type="text" name="guest_name[]" id="guest_name">
                <br />
                <label for="guest_surname">Nazwisko:</label>
                <input type="text" name="guest_surname[]" id="guest_surname">
                <br />
                <label for="guest_age">Wiek:</label>
                <input type="number" name="guest_age[]" id="guest_age">
                <br />
            </fieldset>
        </fieldset>


        <fieldset>
            <legend>Udogodnienia</legend>
            <label for="smoking">Popielniczka:</label>
            <input type="checkbox" name="smoking" id="smoking">
            <br />
            <label for="baby_bed">Łóżeczko dla dziecka:</label>
            <input type="checkbox" name="baby_bed" id="baby_bed">
            <br />
            <label for="air_conditioning">Klimatyzacja:</label>
            <input type="checkbox" name="air_conditioning" id="air_conditioning">
        </fieldset>
        <input type="submit" value="Zarezerwuj">
    </form>
</fieldset>

<script>
    const guests = document.getElementById('guests');
    const originalGuestsFieldset = guests.querySelector('fieldset');
    const guestsFieldset = originalGuestsFieldset.cloneNode(true);
    // Usuwamy oryginalne pola dla gości
    originalGuestsFieldset.remove();

    const people = document.querySelector('#people');

    // Tworzymy listener na zmianę ilości osób
    people.addEventListener('change', (event) => {
        const peopleNumber = event.target.value;
        guests.innerHTML = '<legend>Dane Gości</legend>';
        // Tworzymy nowe pola dla gości
        for (let i = 1; i <= peopleNumber; i++) {
            const newGuest = guestsFieldset.cloneNode(true);
            newGuest.querySelector('legend').innerText = `Gość ${i}`;
            guests.append(newGuest);
        }
    });

    // Wywołujemy event change na elemencie people, aby załadować pola dla 1 osoby
    people.dispatchEvent(new Event('change'));


</script>