import React from 'react';
import '@testing-library/jest-dom';
import {shallow} from 'enzyme';
import { GifGridItem } from '../../../components/gif/GifGridItem';
describe('GifGridItem Test Funciones', () => {
    
    const title = 'Hola mundo';
    const url = 'https://localhost/algo.jpg';
    
    let wraper = shallow(<GifGridItem title={title} url={url} />);

    beforeEach( () => {
        wraper = shallow(<GifGridItem title={title} url={url} />);
    });

    test('GifGridItem', () => {
        expect(wraper).toMatchSnapshot();
    })

    test('debe de tener un parrafo con el title', () => {
        const textoParrafo = wraper.find('p').text();
        expect(textoParrafo.trim()).toBe(title);
    })

    test('debe de tener la imagen igual al url y alt de los props', () => {
        const img = wraper.find('img');
        expect(img.prop('src')).toBe(url);
        expect(img.prop('alt')).toBe(title);
    })
    
    test('debe de tener animate__bounce ', () => {
        const className = wraper.find('div').prop('className');
        expect(className.includes('animate__bounce')).toBe(true);
    })
    
})