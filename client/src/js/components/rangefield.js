import noUiSlider from 'nouislider';

const SETTINGS_ATTR = 'data-settings';
const VALUE_ATTR = 'value';
const SLIDER_CLASS = 'noUi-target';
const ELEMENT_SELECTOR = 'div[data-range=rangefield]';

const observerConfig = {
  attributes: false,
  characterData: false,
  childList: true,
  subtree: true
};

const format = (unit, decimalPlaces) => value => parseFloat(value).toFixed(decimalPlaces) + unit;

const fieldWithName = fieldName => document.body.querySelectorAll(`input[name=${fieldName}]`)[0];

const fieldDescriptionWithName = fieldName => document.body.getElementsByClassName(`${fieldName}-range-description`)[0];

const valueToArray = value => (!Array.isArray(value) ? [value] : value);

const hasFormatSettings = settings => settings.unit && (settings.decimalPlaces > -1);

const updateElementValue = (settings, fieldName, value) => {
  const input = fieldWithName(fieldName);
  const description = fieldDescriptionWithName(fieldName);
  const formatter = format(settings.unit, settings.decimalPlaces);
  const displayValue = hasFormatSettings(settings) ? value.map(formatter) : value;

  input.setAttribute(VALUE_ATTR, value.join(','));
  description.innerHTML = displayValue.join(' ');
};

const mountRangeField = (rangefield) => {
  const fieldName = rangefield.getAttribute(SETTINGS_ATTR);
  const input = fieldWithName(fieldName);
  const settings = window[fieldName];

  settings.start = valueToArray(settings.start);

  if (input.hasAttribute(VALUE_ATTR)) {
    const values = input.getAttribute(VALUE_ATTR).split(',');
    if (values.length === settings.start.length) {
      settings.start = values;
    }
  }
  noUiSlider.create(rangefield, settings);

  rangefield.noUiSlider.on('update', () => {
    const value = valueToArray(rangefield.noUiSlider.get());
    updateElementValue(settings, fieldName, value);
  });

  updateElementValue(settings, fieldName, settings.start);
};

const mount = () => {
  // If things change and we haven't painted our UiSlider yet, go for it
  if (document.body.getElementsByClassName(SLIDER_CLASS).length === 0) {
    const ranges = document.body.querySelectorAll(ELEMENT_SELECTOR);
    ranges.forEach(mountRangeField);
  }
};

const onMutation = () => mount();

/** global: MutationObserver */
const observerFactory = callback => new MutationObserver(callback);

const loadRangeSlider = (createObserver = observerFactory) => {
  mount(); // mount any relevant elements in the dom on load
  createObserver(onMutation).observe(document.body, observerConfig);
};

export default loadRangeSlider;
