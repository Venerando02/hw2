const X_IMAGE_MENU = 'immagini/x.png';
const MENU_IMAGE_PNG = 'immagini/menu.png';
const colonna1 = document.querySelector('#col1');
const colonna2 = document.querySelector('#col2');

function ChangeImageRandom(event) {
    const image = event.currentTarget;
    const index = Math.floor(Math.random() * 2);
    const box_chiuso = document.querySelector('#mistery-box');
    let box_aperto;
    const newtext = document.createElement('h1');

    if (index === 0) {
        box_aperto = document.querySelector('#win-box');
        newtext.textContent = 'Sei fortunato! Questa giornata la vincerai!';
    } else {
        box_aperto = document.querySelector('#lose-box');
        newtext.textContent = 'Peccato! Le previsioni del mago ti vedono perdente!';
    }

    box_chiuso.classList.add('hidden');
    box_aperto.classList.remove('hidden');
    box_aperto.appendChild(newtext);
    image.removeEventListener('click', ChangeImageRandom);
}

const image = document.querySelector('#mistery-box img');
image.addEventListener('click', ChangeImageRandom);

function ShowMenu(event) {
    const image_menu = event.currentTarget;
    image_menu.src = X_IMAGE_MENU;
    const menu_aperto = document.querySelector('#menu_item');
    menu_aperto.classList.remove('hidden');
    image_menu.removeEventListener('click', ShowMenu);
    image_menu.addEventListener('click', CloseMenu);
}

function CloseMenu(event) {
    const image_menu_chiuso = event.currentTarget;
    image_menu_chiuso.src = MENU_IMAGE_PNG;
    const menu_open = document.querySelector('#menu_item');
    menu_open.classList.add('hidden');
    image_menu_chiuso.removeEventListener('click', CloseMenu);
    image_menu_chiuso.addEventListener('click', ShowMenu);
}

const image_menu = document.querySelector('#menu-tendina img');
image_menu.addEventListener('click', ShowMenu);

function info_aggiuntive(event) {
    const input_tag = event.currentTarget;
    const info = input_tag.dataset.info;
    const testo = document.createElement('p');
    testo.textContent = info;
    input_tag.parentNode.appendChild(testo);
    input_tag.removeEventListener('click', info_aggiuntive);
}

const input_tag = document.querySelector('#help input');
input_tag.addEventListener('click', info_aggiuntive);

function text_function2(event) {
    clearContainer();
    const blocco = document.createElement('div');
    blocco.classList.add('stile_blocco_scrittura');

    const descrizione1 = document.createElement('span');
    descrizione1.classList.add('style_text');
    descrizione1.textContent = 'In Italia sono poche le persone che non hanno mai sentito nominare la parola Fantacalcio, mentre sono milioni quelle che lo praticano.';

    const descrizione2 = document.createElement('span');
    descrizione2.classList.add('style_text');
    descrizione2.textContent = 'Il Fantacalcio ha la presunzione di chiamarsi "il gioco più bello del mondo dopo il calcio", anzi, il Fantacalcio è ora forse migliore del calcio reale. Il nostro gioco vuole simulare il calcio soprattutto per quel che riguarda il brivido dello scontro diretto, la campagna acquisti e la vittoria al 90° magari su autogol. In queste pagine troverete una base per capire il gioco e convincere altri amici a fondare una Lega';

    const descrizione3 = document.createElement('span');
    descrizione3.classList.add('style_text');
    descrizione3.textContent = 'Oppure potrete trovare gli argomenti per non farvi prendere per matti nel momento in cui esulterete alla radio, anche quando la vostra squadra del cuore non starà giocando perché impegnata nel posticipo serale. O peggio, come è successo a molti, spingere la vostra fidanzata a occuparsi di calcio, farla giocare a Fantacalcio e vederla dominare il vostro fantacampionato in cui magari voi finirete retrocessi.';

    const descrizione4 = document.createElement('span');
    descrizione4.classList.add('style_text');
    descrizione4.textContent = 'Se è la prima volta che vi avvicinate a Fantacalcio, sappiate che non è un gioco semplice e che dovete essere pronti a dimenticarvi qualche volta la vostra squadra del cuore.';

    const paragrafo = document.createElement('h4');
    paragrafo.textContent = 'Pronti a lanciarvi nella mischia?';

    blocco.appendChild(descrizione1);
    blocco.appendChild(descrizione2);
    blocco.appendChild(descrizione3);
    blocco.appendChild(descrizione4);
    blocco.appendChild(paragrafo);

    const container = document.querySelector('#f-container1');
    container.appendChild(blocco);
}

const button2 = document.querySelector('#b2');
button2.addEventListener('click', text_function2);


function text_function3(event) {
    clearContainer();
    const blocco = document.createElement('div');
    blocco.classList.add('stile_blocco_scrittura');

    const titolo = document.createElement('h2');
    titolo.textContent = 'Mantra Experience';
    blocco.appendChild(titolo);

    const descrizione1 = document.createElement('p');
    descrizione1.classList.add('style_text');
    descrizione1.textContent = "Il sistema Mantra rappresenta l'evoluzione naturale dei fantasy games basati sul calcio e si rivolge a chi desidera un'esperienza di gioco più coinvolgente e che enfatizzi il valore e le scelte di ogni fantallenatore.";
    blocco.appendChild(descrizione1);

    const descrizione2 = document.createElement('p');
    descrizione2.classList.add('style_text');
    descrizione2.textContent = "Facile da giocare molto più di quanto si possa immaginare, Mantra ha conquistato da subito la fetta più esigente dei fantappassionati italiani, trasformando in realtà concreta quanto promesso dal suo slogan di lancio chi prova Mantra non torna più indietro. I plus di questo sistema di gioco possono essere così riassunti:";
    blocco.appendChild(descrizione2);

    const descrizione3 = document.createElement('p');
    descrizione3.classList.add('style_text');
    descrizione3.textContent = " - Enfasi della funzione manageriale. Non basta più ‘indovinare’ l’attacco, ma va costruita ‘una squadra’ completa e strutturata in base alle proprie esigenze ed idee tattiche.";
    blocco.appendChild(descrizione3);

    const descrizione4 = document.createElement('p');
    descrizione4.classList.add('style_text');
    descrizione4.textContent = " - La tattica diventa parte attiva del gioco. Lo schieramento della formazione, così come quello della panchina, diventa meno scontato e strettamente correlato alle opportunità tattiche offerte dalla rosa a disposizione.";
    blocco.appendChild(descrizione4);

    const descrizione5 = document.createElement('p');
    descrizione5.classList.add('style_text');
    descrizione5.textContent = " - Le dinamiche di mercato acquisiscono appeal. Si cambia e si scambia anche in funzione dei moduli di gioco sui quali è costruita l’ossatura della squadra.";
    blocco.appendChild(descrizione5);

    const container = document.querySelector('#f-container1');
    container.appendChild(blocco);
}

const button3 = document.querySelector('#b3');
button3.addEventListener('click', text_function3);

function clearContainer() {
    const container = document.querySelector('#f-container1');
    container.innerHTML = '';
}

function restore_home(event) {
    clearContainer();
    const box = document.querySelector('#f-container1');
    box.appendChild(colonna1);
    box.appendChild(colonna2);
}

const button1 = document.querySelector('#b1');
button1.addEventListener('click', restore_home);



function removedati(event) {
    event.stopPropagation();
    const info_utente = document.querySelector('#informazioni-utente');
    info_utente.classList.add('hidden');
    profilo_utente.removeEventListener('click', removedati);
    profilo_utente.addEventListener('click', mostradati);
}

function mostradati(event) {
    event.stopPropagation();
    const info_utente = document.querySelector('#informazioni-utente');
    info_utente.classList.remove('hidden');
    profilo_utente.removeEventListener('click', mostradati);
    profilo_utente.addEventListener('click', removedati);
}


const profilo_utente = document.querySelector('#utente-loggato');
profilo_utente.addEventListener('click', mostradati);


