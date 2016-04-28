var CF = function() {
  // set dbg to true to get console logging
  var prv = this,
      dbg = false;

  prv.init = function(el) {
    dbg && console.log('initing CF');
    prv.els = {
      form: el,
      errors: el.querySelector('#errors'),
      button: el.querySelector('button'),
      input: el.querySelector('input[type=text]'),
      results: document.getElementById('results'),
      closeBtn: el.querySelector('.close')
    };
    document.body.classList.add('has-js');

    prv.bindEvents();
    dbg && console.log('inited successfully');
  };

  prv.bindEvents = function() {
    dbg && console.log('Binding event listeners');
    prv.els.button.addEventListener('click', prv.buttonClicked);
    prv.els.results.addEventListener('click', prv.isOlClicked);
  };

  prv.buttonClicked = function(e) {
    e.preventDefault();
    dbg && console.log('Submit button was clicked');
    prv.sendRequest();
  };

  prv.sendRequest = function() {
    dbg && console.log('Will send request with next value: ', prv.els.input.value);
    var xhr = new XMLHttpRequest();
    var Data = new FormData();
    Data.append('value', prv.els.input.value);
    xhr.onreadystatechange = function(res) {
        if (res.target.readyState === 4) {
          dbg && console.log('we have succsefully received an answer from /ajax url');
          prv.renderStuff(res.target.responseText);
        }
    };
    xhr.open('POST', '/ajax', true);
    xhr.send(Data);
  };

  prv.renderStuff = function(data) {
    var json = JSON.parse(data);

    if (json.status === 'valid') {
      prv.els.errors.innerHTML = '';
      prv.els.results.innerHTML = json.coins;
      prv.els.results.querySelector('.close').addEventListener('click', prv.closeOverlay);
    } else {
      prv.els.errors.innerHTML = json.errors;
    }
  };

  prv.isOlClicked = function(e) {
    (e.target.classList.contains('result')) && prv.closeOverlay();
  }

  prv.closeOverlay = function() {
    prv.els.results.innerHTML = '';
    prv.els.input.value = '';
  }
};

// if js enabled, use window onload callback to initialize our front-end improvements
window.onload = function() {
  var form = document.querySelector('form.form');
  if (form) {
    var Form = new CF();
    Form.init(form);
  }
};
