import React, { useState } from 'react';
import { AddCategory } from './category/AddCategory';
import { GifGrid } from './gif/GifGrid';

const GifExpertApp = () => {

    const [categories, setCategory] = useState(['one pice']);

    return (
        <>
            <h2>GifExpertApp</h2>
            <AddCategory setCategories={setCategory}/>
            <hr />
            
            <ol>
                {
                    categories.map( (category, index) =>
                        <GifGrid 
                        key={category}
                        category={category}
                        />
                    )
                }
            </ol>
        </>
    );
}

export default GifExpertApp;

