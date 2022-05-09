import Bio from './modules/Bio.js'
import Gallery from './modules/Gallery.js'
import Nav from './modules/Nav.js'
import Footer from './modules/Footer.js'


const app =() => {
    return `
        ${Nav()}
        <div class="container">
            ${Bio()}
            ${Gallery()}
            ${Footer()}
        </div>
    `
}

document.getElementById('root').innerHTML = app();

