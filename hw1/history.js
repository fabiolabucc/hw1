function search(event) {
    event.preventDefault();
    const characterInput = document.getElementById('character').value;
    const characterValue = encodeURIComponent(characterInput);
    
    fetch(`fetch_character.php?character=${characterValue}`)
      .then(searchResponse).then(onJson);
  }
  
function searchResponse(response){
  console.log(response);
  return response.json();
}
  
function onJson(json) {
    console.log('JSON received', json);
    const library = document.querySelector('#library-view');
    library.innerHTML = '';
  
    if (!json.success || json.data.length === 0) {
      document.querySelector('.error-hidden').style.display = 'block';
      return;
    } else {
      document.querySelector('.error-hidden').style.display = 'none';
    }
  
    const characters = json.data;
    for (const character of characters) {
      const characterInfo = document.createElement('div');
      characterInfo.classList.add('character-info');
  
      const name = document.createElement('h3');
      name.textContent = character.name;
      characterInfo.appendChild(name);
  
      const img = document.createElement('img');
      img.src = character.imageUrl;
      characterInfo.appendChild(img);
  
      if (character.films) {
        const filmsParagraph = document.createElement('p');
        filmsParagraph.innerHTML = "<span class='colorSpan'>Films: </span>" + character.films;
        characterInfo.appendChild(filmsParagraph);
      }
  
      if (character.tvShows) {
        const tvShowsParagraph = document.createElement('p');
        tvShowsParagraph.innerHTML = "<span class='colorSpan'>Tv Shows: </span>" + character.tvShows;
        characterInfo.appendChild(tvShowsParagraph);
      }
  
      if (character.videoGames) {
        const videoGamesParagraph = document.createElement('p');
        videoGamesParagraph.innerHTML = "<span class='colorSpan'>VideoGames: </span>" + character.videoGames;
        characterInfo.appendChild(videoGamesParagraph);
      }
  
      if (character.parkAttractions) {
        const parkAttractionsParagraph = document.createElement('p');
        parkAttractionsParagraph.innerHTML = "<span class='colorSpan'>Park Attractions: </span>" + character.parkAttractions;
        characterInfo.appendChild(parkAttractionsParagraph);
      }
  
      library.appendChild(characterInfo);
    }
  }
  

const form = document.querySelector('form');
form.addEventListener('submit', search);