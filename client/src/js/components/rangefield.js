import noUiSlider from 'nouislider';

const observerConfig = {
  attributes: false,
  characterData: false,
  childList: true,
  subtree: true
};

const mountRangeField = (rangefield) => {
  let fieldName = rangefield.getAttribute('data-settings');
  let input = document.body.querySelectorAll(`input[name=${fieldName}]`)[0];
  let settings = window[fieldName];
  if (input.hasAttribute('value')) {
    let values = input.getAttribute('value').split(',');
    if (values.length === settings['start'].length) {
      settings['start'] = values;
    }
  }
  noUiSlider.create(rangefield, settings);

  rangefield.noUiSlider.on('update', function () {
    let description = document.body.getElementsByClassName(`${fieldName}-range-description`)[0];
    let value = rangefield.noUiSlider.get();
    if (!Array.isArray(value)) {
      value = [value];
    }
    input.setAttribute('value', value.join(','));
    description.innerHTML = value.join(' ');
  });
}

const mount = () => {
  // If things change and we haven't painted our UiSlider yet, go for it
  if (document.body.getElementsByClassName('noUi-target').length === 0) {
    const ranges = document.body.querySelectorAll('div[data-range=rangefield]');
    ranges.forEach(mountRangeField);
  }
}


const onMutation = () => mount();

const observerFactory = callback => new MutationObserver(callback);

const loadRangeSlider = (createObserver = observerFactory) => {
  mount(); //mount any elements in the dom on load
  createObserver(onMutation).observe(document.body, observerConfig);
};

export default loadRangeSlider;
