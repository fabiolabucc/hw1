function onJson(json) {
  console.log('JSON ricevuto');
  const library = document.querySelector('#library-view');
  library.innerHTML = '';

  let num_results = json.info.count;

  if (num_results == 0) {
    document.querySelector('.error-hidden').style.display = 'block';
    return;
  } else {
      document.querySelector('.error-hidden').style.display = 'none';
  }

  if (num_results > 0) {
    saveCharacter();
  }

  //si mette doc perché doc può essere undefined se l'array json.data ha meno elementi di num_results.
 //Quando si accede a doc.imageUrl, il codice si interrompe con un errore se doc è undefined, e quindi non mostra risultati.
  for (let i = 0; i < num_results; i++) {
      const doc = json.data[i];
      if (!doc || !doc.imageUrl) {
          continue; 
      }

      const characterInfo = document.createElement('div');
      characterInfo.classList.add('character-info');

      const name = document.createElement('h3');
      name.textContent = doc.name;
      characterInfo.appendChild(name);

      const img = document.createElement('img');
      img.src = doc.imageUrl;
      characterInfo.appendChild(img);

      if (doc.films.length > 0) {
          const filmsParagraph = document.createElement('p');
          filmsParagraph.innerHTML = "<span class='colorSpan'>Films: </span>" + doc.films.join(",");
          characterInfo.appendChild(filmsParagraph);
      }

      if (doc.tvShows.length > 0) {
          const tvShowsParagraph = document.createElement('p');
          tvShowsParagraph.innerHTML = "<span class='colorSpan'>Tv Shows: </span>" + doc.tvShows.join("</span>, <span class='tv-shows'>") + "</span>";
          characterInfo.appendChild(tvShowsParagraph);
      }

      if (doc.videoGames.length > 0) {
          const videoGamesParagraph = document.createElement('p');
          videoGamesParagraph.innerHTML = "<span class='colorSpan'>VideoGames: </span>" + doc.videoGames.join("</span>, <span class='video-games'>") + "</span>";
          characterInfo.appendChild(videoGamesParagraph);
      }

      if (doc.parkAttractions.length > 0) {
          const parkAttractionsParagraph = document.createElement('p');
          parkAttractionsParagraph.innerHTML = "<span class='colorSpan'>Park Attractions: </span>" + doc.parkAttractions.join("</span>, <span class='park-attractions'>") + "</span>";
          characterInfo.appendChild(parkAttractionsParagraph);
      }

      library.appendChild(characterInfo);
  }
}

function onResponse(response) {
  console.log('Risposta ricevuta');
  return response.json();
}

function search(event) {
  // Impedisci il submit del form
  event.preventDefault();
  // Leggi valore del campo di testo
  const character_input = document.querySelector('#character');
  const character_value = encodeURIComponent(character_input.value);
  console.log('Eseguo ricerca: ' + character_value);

  const base_url = 'disney_api.php?name=' + character_value;
  console.log('URL: ' + base_url);

  fetch(base_url).then(onResponse).then(onJson);
}

function saveCharacter() {
  console.log("Salvataggio");

  const cards = document.querySelectorAll('.character-info');

  cards.forEach(card => {
    const formData = new FormData();
    formData.append('name', card.querySelector('h3').textContent);
    formData.append('imageUrl', card.querySelector('img').src);
    formData.append('films', card.querySelector('.films').textContent);
    formData.append('tvShows', card.querySelector('.tv-shows').textContent);
    formData.append('videoGames', card.querySelector('.video-games').textContent);
    formData.append('parkAttractions', card.querySelector('.park-attractions').textContent);

    fetch("save_character.php", { method: 'POST', body: formData })
      .then(dispatchResponse)
      .catch(dispatchError);
  });
}


const form = document.querySelector('form');
form.addEventListener('submit', search);
