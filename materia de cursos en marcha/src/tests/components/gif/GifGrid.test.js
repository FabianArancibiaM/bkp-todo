import React from 'react';
import '@testing-library/jest-dom';
import {shallow} from 'enzyme';
import { GifGrid } from '../../../components/gif/GifGrid';
describe('GifGrid Test Funciones', () => {
    let wraper = shallow(<GifGrid />);
    beforeEach( () => {
        wraper = shallow(<GifGrid />);
    });
    test('GifGrid', () => {
        expect(wraper).toMatchSnapshot();
    })
})