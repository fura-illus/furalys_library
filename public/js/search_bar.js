const searchLink = document.querySelector('.search-link');
const search = document.querySelector('.search');
const searchInput = document.querySelector('.input-search');
const closeSearch = document.querySelector('.close-search');

searchLink.addEventListener('click', () => {
    search.className = "search"
    search.classList.toggle('active')
    searchInput.focus()
})

closeSearch.addEventListener('click', () => {
    search.className = "search hidden"
})