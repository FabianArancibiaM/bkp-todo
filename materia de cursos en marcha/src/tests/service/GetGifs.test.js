import React from 'react';
import '@testing-library/jest-dom';
import {shallow} from 'enzyme';
import { getGifs } from '../../service/GetGif';
describe('getGifs Test Funciones', () => {
    
    test('Debe de traer 10 elementos', async () => {
        const gif = await getGifs('one piece');
        expect(gif.length).toBe(10)
    })

    test('Debe de traer 10 elementos', async () => {
        const gif = await getGifs('');
        expect(gif.length).toBe(0)
    })
})