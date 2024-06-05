function onJson(json) {
  console.log('JSON ricevuto');
  const library = document.querySelector('#library-view');
  library.innerHTML = '';

  let num_results = json.data.length;

  if (num_results === 0) {
      document.querySelector('.error-hidden').style.display = 'block';
      return;
  } else {
      document.querySelector('.error-hidden').style.display = 'none';
  }

  for (let i = 0; i < num_results; i++) {
      const doc = json.data[i];
      if (!doc || !doc.assets || !doc.assets.preview_1000) {
          continue; 
      }

      const imageInfo = document.createElement('div');
      imageInfo.classList.add('image-info');

      const description = document.createElement('h3');
      description.textContent = doc.description;
      imageInfo.appendChild(description);

      const img = document.createElement('img');
      img.src = doc.assets.preview_1000.url;
      imageInfo.appendChild(img);

      library.appendChild(imageInfo);
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
  const image_input = document.querySelector('#image');
  const image_value = encodeURIComponent(image_input.value);
  console.log('Eseguo ricerca: ' + image_value);

  const base_url = 'shutterstock_api.php?image=' + image_value;
  console.log('URL: ' + base_url);

  fetch(base_url).then(onResponse).then(onJson);
}

const form = document.querySelector('form');
form.addEventListener('submit', search);


