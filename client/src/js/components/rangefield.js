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
        let settings = window[fieldName];
        let values = input.getAttribute('value').split(',');
        if (input.hasAttribute('value') && values.length === settings['start'].length) {
          settings['start'] = values;
        }
        noUiSlider.create(rangefield, settings);

        rangefield.noUiSlider.on('update', function () {
          let description = document.body.getElementsByClassName(`${fieldName}-range-description`)[0];
          let value = rangefield.noUiSlider.get();
          if (!Array.isArray(value)) {
            value = [value];
          }
          input.setAttribute('value', value.join(','));
          console.log(value);
          description.innerHTML = value.join(' ');
        });
      });
    }
  });
}
