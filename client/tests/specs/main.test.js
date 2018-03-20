/* global describe, expect, it, jest */
import main from '../../src/js/main';
import * as rangefield from '../../src/js/components/rangefield';

describe('main', () => {
  it('initilises rangefield module', () => {
    const rangefieldSpy = jest.spyOn(rangefield, 'default');
    main();
    expect(rangefieldSpy).toHaveBeenCalled();
  });
});
