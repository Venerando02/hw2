fetch(BASE_URL + 'Spotify').then(OnResponse).then(OnJson);

function OnResponse(response) {
    return response.json();
}

function OnJson(json) {
    const token = document.head.querySelector('meta[name="csrf-token"]').content;
    console.log(token);
    console.log(json);
    const albums = json.albums.items;
    console.log(albums);
    const limitedAlbums = albums.slice(0, 20);
    limitedAlbums.forEach(album => {
        const formdata = new FormData();
        const id_album = album.id;
        const nomeAlbum = album.name;
        const artista = album.artists[0].name;
        const immagine_album = album.images[1].url;
        const data_rilascio = album.release_date;
        const url = album.href;
        formdata.append('id', id_album);
        formdata.append('nome', nomeAlbum);
        formdata.append('artista', artista);
        formdata.append('immagine', immagine_album);
        formdata.append('data', data_rilascio);
        formdata.append('url', url);
        fetch(BASE_URL + 'InsertAlbum',
        {
            method: 'POST',
            body: formdata, 
            headers: { 'X-CSRF-TOKEN': token }
        })
        .then(OnInsertResponse)
        .then(OnInsertJson);
    });
}

function OnInsertResponse(response) {
    return response.json();
}

function OnInsertJson(json) {
    console.log(json);
}

Inserimento()

function Inserimento() {
    fetch(BASE_URL + 'MostraAlbum')
    .then(ResponseInserimento)
    .then(JsonInserimento);
}


function ResponseInserimento(response) {
    return response.json();
}

function JsonInserimento(json) {
    console.log(json);
    if (json.response) {
        const albums = json.albums;

        const albumSection = document.getElementById('sezione-album');

        albums.forEach(album => {

            const id = album.id;

            const albumDiv = document.createElement('div');
            albumDiv.classList.add('album');

            const albumName = document.createElement('h2');
            albumName.textContent = album.nome;

            const artistName = document.createElement('p');
            artistName.textContent = 'Artista: ' + album.artista;

            const releaseDate = document.createElement('p');
            releaseDate.textContent = 'Data di rilascio: ' + album.data;

            const albumImage = document.createElement('img');
            albumImage.src = album.immagine;

            const commentReactDiv = document.createElement('div');
            commentReactDiv.classList.add('comment-react');

            const likeButton = document.createElement('button');
            const likeCount = document.createElement('span');

            const likeSvg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
            likeSvg.setAttribute('xmlns', 'http://www.w3.org/2000/svg');
            likeSvg.setAttribute('width', '22');
            likeSvg.setAttribute('height', '22');
            likeSvg.setAttribute('viewBox', '0 0 24 24');
            likeSvg.setAttribute('fill', 'none');

            const likePath = document.createElementNS('http://www.w3.org/2000/svg', 'path');
            likePath.setAttribute('d', 'M19.4626 3.99415C16.7809 2.34923 14.4404 3.01211 13.0344 4.06801C12.4578 4.50096 12.1696 4.71743 12 4.71743C11.8304 4.71743 11.5422 4.50096 10.9656 4.06801C9.55962 3.01211 7.21909 2.34923 4.53744 3.99415C1.01807 6.15294 0.221721 13.2749 8.33953 19.2834C9.88572 20.4278 10.6588 21 12 21C13.3412 21 14.1143 20.4278 15.6605 19.2834C23.7783 13.2749 22.9819 6.15294 19.4626 3.99415Z');
            likePath.setAttribute('stroke', '#707277');
            likePath.setAttribute('stroke-width', '2');
            likePath.setAttribute('stroke-linecap', 'round');
            likePath.setAttribute('fill', '#707277');

            likeSvg.appendChild(likePath);
            likeButton.appendChild(likeSvg);

            commentReactDiv.appendChild(likeButton);
            commentReactDiv.appendChild(likeCount);
            commentReactDiv.dataset.id_album = id;
            commentReactDiv.addEventListener('click', GestioneLike);

            albumDiv.appendChild(albumName);
            albumDiv.appendChild(artistName);
            albumDiv.appendChild(releaseDate);
            albumDiv.appendChild(albumImage);
            albumDiv.appendChild(commentReactDiv);

            albumSection.appendChild(albumDiv);
        });
    }
}

function GestioneLike(event) 
{
    event.stopPropagation();
    const button = event.currentTarget;
    const albumDiv = button.parentNode;
    const button_like = button.querySelector('button');
    const contatore_like = button.querySelector('span');
    const id = button.dataset.id_album;
    if(!button_like.classList.contains('liked'))
    {
        button_like.classList.add('liked');    
        fetch( BASE_URL + 'InserisciLike/' + encodeURIComponent(id))
        .then(OnResponseLike)
        .then(json => OnInsertLike(json, contatore_like, albumDiv));
    }
    else
    {
        button_like.classList.remove('liked');
        fetch(BASE_URL + 'RimuoviLike/' + encodeURIComponent(id))
        .then(OnResponseDeleteLike)
        .then(json => OnDeleteLike(json, contatore_like, albumDiv));
    }
}

function OnDeleteLike(json, contatore, div)
{
    if(json.response === true)
    {
        contatore.textContent = json.numero_like;
        RemoveMessage(div);
        const message = document.createElement('p');
        message.textContent = json.message;
        message.classList.add('Error');
        div.appendChild(message);
        setTimeout(function() {
            div.removeChild(message);
        }, 1500);
    }
}

function OnResponseDeleteLike(response)
{
    return response.json();
}

function OnResponseLike(response) 
{
    return response.json();
}

function OnInsertLike(json, contatore, div) 
{
    if(json.response === true)
    {
        contatore.textContent = json.numero_like;
        RemoveMessage(div);
        const message = document.createElement('p');
        message.textContent = json.message;
        message.classList.add('Error');
        div.appendChild(message);
        setTimeout(function() {
            div.removeChild(message);
        }, 1500);
    }
    else
    {
        contatore.textContent = json.numero_like;
        RemoveMessage(div);
        const message = document.createElement('p');
        message.textContent = json.message;
        message.classList.add('Error');
        div.appendChild(message);
        setTimeout(function() {
            div.removeChild(message);
        }, 1500);
    }
}

function RemoveMessage(div)
{
    const message = div.querySelector('.Error'); 
    if(message)
    {
        message.remove();
    }
}