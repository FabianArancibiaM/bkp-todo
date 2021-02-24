import React from 'react';
import '@testing-library/jest-dom';
import {shallow} from 'enzyme';
import GifExpertApp from '../../components/GifExpertApp'; 
describe('GifExpertApp Test Funciones', () => {
    let wraper = shallow(<GifExpertApp />);
    beforeEach( () => {
        wraper = shallow(<GifExpertApp />);
    });
    test('GifExpertApp', () => {
        expect(wraper).toMatchSnapshot();
    })
})