// Exibe uma frase aleatória de frases.json na página inicial do blog.
function tapronto() {
  var base = document.querySelector('meta[name="generator"]') ? '/' : '/';
  fetch('/js/frases.json')
    .then(function (resp) { return resp.json(); })
    .then(function (data) {
      if (!data || data.length === 0) {
        console.log('citacao: nenhuma frase!');
        return;
      }
      var fraseAleatoria = data[Math.floor(Math.random() * data.length)];
      console.log('citacao: ' + fraseAleatoria);

      // Só exibe na página inicial (índice do blog)
      var path = window.location.pathname;
      if (path !== '/' && path !== '/index.html' && !path.endsWith('/page/') && !/\/page\/\d+\//.test(path)) {
        return;
      }
      var h1 = document.querySelector('h1#blog, h1');
      if (!h1) return;

      var p = document.createElement('p');
      p.id = 'fraseAleatoria';
      p.style.fontStyle = 'italic';
      p.style.textAlign = 'center';
      p.style.opacity = '0.8';
      p.textContent = fraseAleatoria;
      h1.parentNode.insertBefore(p, h1.nextSibling);
    })
    .catch(function () {
      console.log('citacao: erro!');
    });
}

document.addEventListener('DOMContentLoaded', tapronto);
