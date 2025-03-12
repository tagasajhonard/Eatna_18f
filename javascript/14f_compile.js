const files = ['a', 'b', 'c', 'e'];

files.forEach(file => {
  fetch(`14f_cubicles/${file}.html`)
    .then(response => response.text())
    .then(data => {
      const container = document.createElement('div');
      container.innerHTML = data;
      document.getElementById(file).appendChild(container);

      container.querySelectorAll('button').forEach(button => {
        button.addEventListener('click', () => {
          openForm(button.value);
        });
      });
    });
});
