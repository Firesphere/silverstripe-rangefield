import noUiSlider from 'nouislider';

export default function () {
  // Listen to the DOM for changes
  window.document.addEventListener('DOMSubtreeModified', () => {
    // If things change and we haven't painted our UiSlider yet, go for it
    if (document.body.getElementsByClassName('noUi-target').length === 0) {

      const ranges = document.body.querySelectorAll('div[data-range=rangefield]');

      ranges.forEach((rangefield) => {

        let fieldName = rangefield.getAttribute('data-settings');
        let input = document.body.querySelectorAll(`input[name=${fieldName}]`)[0];
        let description = document.body.getElementsByClassName(`${fieldName}-range-description`)[0];
        let settings = window[fieldName];
        if (input.hasAttribute('value')) {
          settings['start'] = input.getAttribute('value');
        }
        noUiSlider.create(rangefield, settings);

        rangefield.noUiSlider.on('update', function () {
          let value = rangefield.noUiSlider.get();
          input.setAttribute('value', value);
          description.innerHTML = value;
        });
      });
    }
  });
}
