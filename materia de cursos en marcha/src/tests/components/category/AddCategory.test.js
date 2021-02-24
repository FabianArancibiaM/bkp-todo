import React from 'react';
import '@testing-library/jest-dom';
import {shallow} from 'enzyme';
import { AddCategory } from '../../../components/category/AddCategory';
describe('AddCategory Test Funciones', () => {
    const setCategories = () => {};
    let wraper = shallow(<AddCategory setCategories={setCategories}/>);
    beforeEach( () => {
        wraper = shallow(<AddCategory setCategories={setCategories}/>);
    });
    test('AddCategory', () => {
        expect(wraper).toMatchSnapshot();
    })
})