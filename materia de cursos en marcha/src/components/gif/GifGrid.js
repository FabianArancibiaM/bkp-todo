import React from 'react'
import { useFetchGifs } from '../../hooks/useFetchGifs';
import {GifGridItem} from './GifGridItem';

export const GifGrid = ({category}) => {

    const {data: images, loading} = useFetchGifs(category);
    
    return (
        <div className="card-grid animate__animated animate__fadeIn">
            <h3>{category}</h3><br/>
                {loading && <p className="card-grid animate__animated animate__flash" >Loading...</p> }
                {
                    images.map( (img)=> 
                        <GifGridItem 
                        key={img.id}
                        { ...img } 
                        />
                    )
                }
        </div>
    )
}

