export const getGifs = async (category) => {
    const URL = `https://api.giphy.com/v1/gifs/search?q=${encodeURI(category)}&limit=10&api_key=piñasLEEI5aNl33nAtq6Atl7ceXK56BK0YA3`;
    const resp = await fetch(URL);
    const {data} = await resp.json();
    const gifs = data.map( img =>{
        return {
            id: img.id,
            title: img.title,
            url: img.images?.downsized_medium.url
        }
    })
    return gifs;
}